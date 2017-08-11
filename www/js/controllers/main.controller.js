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

    $scope.addColumn = function() {
      $mockdata.addColumn()
      // save new
    }

    $scope.addRow = function(data) {
      console.log(data)
      $mockdata.addRow(data)
      /// save new
    }

    $scope.deleteRow = function(index) {
      $mockdata.deleteRow(index)
    }

    $scope.deleteColumn = function(index) {
      $mockdata.deleteColumn(index)
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
