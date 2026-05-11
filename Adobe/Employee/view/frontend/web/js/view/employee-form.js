/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'uiComponent',
    'ko',
    'jquery',
    'mage/url'
], function (Component, ko, $, urlBuilder) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Adobe_Employee/employee-form'
        },

        initialize: function () {
            this._super();
            var data = this.employeeData || {};
            this.formTitle = ko.observable(data.entity_id ? 'Edit Employee' : 'Create Employee');
            this.entity_id = ko.observable(data.entity_id || '');
            this.name = ko.observable(data.name || '');
            this.joining_date = ko.observable(data.joining_date || '');
            this.designation = ko.observable(data.designation || '');
            this.address = ko.observable(data.address || '');
            this.hobbies = ko.observable(data.hobbies || '');
            this.status = ko.observable(data.status || '1');
            return this;
},

        saveEmployee: function () {
            var self = this;

            $.ajax({
                url: urlBuilder.build('employee/index/save'),
                type: 'POST',
                dataType: 'json',
                data: {
                    entity_id: self.entity_id(),
                    name: self.name(),
                    joining_date: self.joining_date(),
                    designation: self.designation(),
                    address: self.address(),
                    hobbies: self.hobbies(),
                    status: self.status()
                },
                success: function (response) {
                    alert(response.message);
                    if (response.success) {
                        window.location.href = urlBuilder.build('employee/index/index');
                    }
                }
            });
        }
    });
});