angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $mockdata) {

  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  $scope.$on('$ionicView.enter', function(e) {
    console.log("AppCtrl Loaded.")
  });
  
  $timeout(function(){
    $ionicSideMenuDelegate.canDragContent(false)
  },50)

  $scope.reportTitle = "Title Goes Here"

  $scope.DATA = $mockdata.get()
  $scope.addColumn = function(){
    $mockdata.addColumn()
    // save new
  }

  $scope.addRow = function(){
    $mockdata.addRow()
    /// save new
  }

  $scope.deleteRow = function(index){
    $mockdata.deleteRow(index)
  }

  $scope.deleteColumn = function(index){
    $mockdata.deleteColumn(index)
  }

  $scope.onColDropComplete = function($index, $data ,$event){
    $mockdata.moveColumn($index,$data,$event)
  }

  $scope.onRowDropComplete = function($index, $data ,$event){
    $mockdata.moveRow($index,$data,$event)
  }

  $scope.onMilestoneMove = function($event){
    console.log("Move: ",$event)
  }
})