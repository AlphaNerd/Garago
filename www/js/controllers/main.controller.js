angular.module('starter.controllers', [])

  .controller('AppCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $mockdata) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function(e) {
      console.log("AppCtrl Loaded.")
    });

    $timeout(function() {
      $ionicSideMenuDelegate.canDragContent(false)
    }, 50)

    $scope.reportTitle = $mockdata.getReportTitle()

    $scope.showEmuneration = false

    $scope.settingsTabs = 'settings'

    $scope.themeData = $mockdata.getTheme()

    //// color picker options
    $scope.pickerSettings = {
      label: "Choose a color",
      icon: "",
      default: $scope.themeData.colors[0],
      genericPalette: false,
      history: false
    };

    $mockdata.getPlan({
      id: null,
      status: "get",
      posEvent: "plan",
      data: null,
      planing_id: 1,
      historical_planing_id: 1,
      image: null
    }).then(function(res) {
      console.log("Initial Data: ", res)
      $scope.DATA = res.data
    })

    $scope.addColumn = function(index,data) {
      console.log(data)
      $mockdata.addColumn(data).then(function(res){
        $scope.DATA = res.data
      })
    }

    $scope.addRow = function(data) {
      $mockdata.addRow(data).then(function(res){
        $scope.DATA.axis.push({
          Axis: res.data[0],
          detail_planning: res.data[1]
        })
      })
    }

    $scope.deleteRow = function(index,obj) {
      $mockdata.deleteRow(index,obj).then(function(res){
        console.log($scope.DATA)
        if(res.data[0] == "<"){
          console.log("Error in deleting")
        }else{
          $scope.DATA.axis.splice(index, 1)
        }
      })
    }

    $scope.deleteColumn = function(index,data) {
      console.log(data)
      $mockdata.deleteColumn(index,data).then(function(res){
        console.log($scope.DATA)
        if(res.data[0] == "<"){
          console.log("Error in deleting")
        }else{
          console.log($scope.DATA)
          $scope.DATA.typePlan.splice(index, 1)
        }
      })
    }

    $scope.onColDropComplete = function($index, $data, $event) {
      $mockdata.moveColumn($index, $data, $event)
    }

    $scope.onRowDropComplete = function($index, $data, $event) {
      $mockdata.moveRow($index, $data, $event)
    }

    $scope.onDragMove = function($event) {
      console.log("Move: ", [$event])
    }

    $scope.toggleLock = function(item) {
      $mockdata.toggleLock(item)

    }

    $scope.openSettings = function() {
      $ionicSideMenuDelegate.toggleRight()
    }

    $scope.toggleEnumeration = function() {
      $scope.showEmuneration = !$scope.showEmuneration
    }

    $scope.settingsTabsSelect = function(selection) {
      $scope.settingsTabs = selection
    }

    $scope.getStyle = {
      'background': Please.make_color(),
      'color': '#fff'
    }

    $scope.createNewPlan = function(){
        $mockdata.newPlan().then(function(res){
          console.log(res)
        })
    }

  })
