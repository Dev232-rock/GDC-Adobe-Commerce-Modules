/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'uiComponent',
    'ko',
    'jquery'
], function (Component, ko, $) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Adobe_Employee/employee'
        },

        employees: ko.observableArray([]),
        currentPage: ko.observable(1),
        pageSize: 5,
        totalPages: ko.observable(1),
        isLoggedIn: ko.observable(false),

        sortField: ko.observable('entity_id'),
        sortDirection: ko.observable('DESC'),

        initialize: function () {
            this._super();
            this.loadEmployees();
            return this;
        },

        loadEmployees: function () {
            var self = this;

            $.get('/employee/index/listing', {
                page: self.currentPage(),
                pageSize: self.pageSize,
                sortField: self.sortField(),
                sortDirection: self.sortDirection()
            }, function (response) {
                self.employees(response.items);
                self.totalPages(response.total_pages);
                self.isLoggedIn(response.is_logged_in);
            });
        },

        sortBy: function (field) {
            if (this.sortField() === field) {
                this.sortDirection(this.sortDirection() === 'ASC' ? 'DESC' : 'ASC');
            } else {
                this.sortField(field);
                this.sortDirection('ASC');
            }

            this.loadEmployees();
        },

        nextPage: function () {
            if (this.currentPage() < this.totalPages()) {
                this.currentPage(this.currentPage() + 1);
                this.loadEmployees();
            }
        },

        prevPage: function () {
            if (this.currentPage() > 1) {
                this.currentPage(this.currentPage() - 1);
                this.loadEmployees();
            }
        },

        goToCreate: function () {
            if (!this.isLoggedIn()) {
                alert('Please login first');
                return;
            }
            window.location.href = '/employee/index/create';
        },

        editEmployee: function (employee) {
            if (!this.isLoggedIn()) {
                alert('Please login first');
                return;
            }
            window.location.href = '/employee/index/edit/id/' + employee.entity_id;
        },

        deleteEmployee: function (employee) {
            if (!this.isLoggedIn()) {
                alert('Please login first');
                return;
            }

            var self = this;

            if (!confirm('Are you sure you want to delete this employee?')) {
                return;
            }

            $.ajax({
                url: '/employee/index/delete',
                type: 'POST',
                dataType: 'json',
                data: {
                    entity_id: employee.entity_id
                },
                success: function (response) {
                    alert(response.message);
                    self.loadEmployees();
                }
            });
        }
    });
});