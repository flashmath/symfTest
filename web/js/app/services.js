/**
 * Created by Fabrice on 09/07/2017.
 */
(function () {
    'use strict';
    var myApp = angular.module('app');
    myApp.service('fileUploadService',function ($http,$q) {
        this.uploadFileToUrl = function (file, uploadUrl) {
            var fileFormData = new FormData();
            fileFormData.append('product[brochure]',file);

            console.log("préparation de l'envoi");
            var deffered = $q.defer();
            $http.post(uploadUrl,fileFormData, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            }).success(function (response) {
                //alert('OK');
               deffered.resolve(response);
            }).error(function (response) {
                deffered.reject(response);
            });

            return deffered.promise;
        }
    });
})();