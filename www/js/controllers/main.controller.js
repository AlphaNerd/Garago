angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $mockdata) {

  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  $scope.$on('$ionicView.enter', function(e) {
    console.log("AppCtrl Loaded.")
  });

  $scope.reportTitle = "Title Goes Here"

  $scope.DATA = $mockdata.get()
  $scope.addColumn = function(){
    $mockdata.addColumn()
  }

  $scope.addRow = function(){
    $mockdata.addRow()
  }

  $scope.deleteRow = function(index){
    $mockdata.deleteRow(index)
  }

  $scope.deleteColumn = function(index){
    $mockdata.deleteColumn(index)
  }

})