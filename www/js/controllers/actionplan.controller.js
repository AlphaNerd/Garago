angular.module('garago.controllers.actionplan', [])

.controller('ActionPlanCtrl', function($scope, $ionicModal, $timeout, $window, $rootScope, $ionicSideMenuDelegate, $garagoAPI, $mockApi, initData) {
    console.log("Action Plan Controller Loaded")

    $rootScope.DATA = initData
    
    $scope.settings = {
        printLayout: true,
        showRuler: true,
        showSpellingSuggestions: true,
        presentationMode: 'edit'
    };

    $scope.sampleAction = function(name, ev) {
        $mdDialog.show($mdDialog.alert()
            .title(name)
            .textContent('You triggered the "' + name + '" action')
            .ok('Great')
            .targetEvent(ev)
        );
    };
    
    $scope.reportTitle = $garagoAPI.getReportTitle()
    
    $scope.showEmuneration = false

    $scope.settingsTabs = 'settings'

    $scope.themeData = $garagoAPI.getTheme()

    //// color picker options
    $scope.pickerSettings = {
        label: "Choose a color",
        icon: "",
        default: $scope.themeData.colors[0],
        genericPalette: false,
        history: false
    };

    function refresh(){
        $garagoAPI.getPlan({
            id: null,
            status: "get",
            posEvent: "plan",
            data: null,
            planing_id: 1,
            historical_planing_id: 1,
            image: null
            }).then(function(res) {
            $scope.DATA = res
        })
    }

    $scope.addColumn = function(index,data) {
        $garagoAPI.addColumn(data).then(function(res){
            $scope.DATA = res.data
        })
    }

    $scope.addRow = function(data) {
        $garagoAPI.addRow(data).then(function(res){
            $scope.DATA = res.data
        })
    }

    $scope.deleteRow = function(index,obj) {
        $garagoAPI.deleteRow(index,obj).then(function(res){
            $scope.DATA = res.data
        })
    }

    $scope.deleteColumn = function(index,data) {
        console.log(data)
        $garagoAPI.deleteColumn(index,data).then(function(res){
            $scope.DATA = res.data
        })
    }

    $scope.onColDropComplete = function($index, $data, $event) {
        $garagoAPI.moveColumn($index, $data, $event).then(function(res){
            $scope.DATA = res.data
        })
    }

    $scope.onRowDropComplete = function($index, $data, $event) {
        $garagoAPI.moveRow($index, $data, $event).then(function(res){
            $scope.DATA = res.data
        })
    }

    $scope.onDragMove = function($event) {
        console.log("Move: ", [$event])
    }

    $scope.toggleLock = function(item,row) {
        console.log(item,row)
        $garagoAPI.toggleLock(item).then(function(res){
            console.log(res)
            item.DetailPlan.locked = !item.DetailPlan.locked
        })
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

    $scope.createNewPlan = function(){
        $garagoAPI.newPlan().then(function(res){
            console.log(res)
            $scope.DATA = res.data
        })
    }

    if(initData == false){
        $garagoAPI.newPlan().then(function(res){
            console.log(res)
            $scope.DATA = res.data
        })
    }
})