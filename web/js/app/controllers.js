/**
 * Created by Fabrice on 09/07/2017.
 */
(function () {
    'use strict';
    var myApp = angular.module('app');
    myApp.controller('FileUploadController', function ($scope,fileUploadService) {
        $scope.uploadFile = function(){
            var file = $scope.myFile;
            var uploadUrl = '/product/new',
                promise = fileUploadService.uploadFileToUrl(file,uploadUrl);
            promise.then(function (response) {
                //alert('Message recu');
                //$scope.serverResponse = response;
                //$scope.serverResponse.html(response);
                $('#divResponse').html(response);
                //$scope.content = response
            }, function () {
                $scope.serverResponse = 'An error has occured';
            })

        };
    });
})();