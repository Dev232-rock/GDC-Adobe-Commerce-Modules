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

        initialize: function () {
            this._super();
            this.loadEmployees();
        },

        loadEmployees: function () {
            var self = this;

            $.ajax({
                url: '/rest/V1/employees',
                type: 'GET',
                success: function (response) {
                    self.employees(response);
                },
                error: function () {
                    console.log('Failed to load employees');
                }
            });
        }
    });
});