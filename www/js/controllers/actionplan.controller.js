angular.module('garago.controllers.actionplan', [])

    .controller('ActionPlanCtrl', function ($scope, $ionicModal, $timeout, $window, $rootScope, $ionicSideMenuDelegate, $garagoAPI, $mockApi, initData, $mdBottomSheet, $mdToast) {
        console.log("Action Plan Controller Loaded")

        $rootScope.DATA = initData

        $scope.reportTitle = $garagoAPI.getReportTitle()

        $scope.showEmuneration = false

        $scope.themeData = $garagoAPI.getTheme()

        $scope.docLock = false;
        $scope.docLockToggle = function () {
            $scope.docLock = !$scope.docLock
            console.log($scope.docLock)
        }

        function refresh() {
            $garagoAPI.getPlan({
                id: null,
                status: "get",
                posEvent: "plan",
                data: null,
                planing_id: 1,
                historical_planing_id: 1,
                image: null
            }).then(function (res) {
                $scope.DATA = res
            })
        }

        $scope.addColumn = function (index, data) {
            $garagoAPI.addColumn(data).then(function (res) {
                $scope.DATA = res.data
            })
        }

        $scope.addRow = function (data) {
            $garagoAPI.addRow(data).then(function (res) {
                $scope.DATA = res.data
            })
        }

        $scope.deleteRow = function (index, obj) {
            $garagoAPI.deleteRow(index, obj).then(function (res) {
                $scope.DATA = res.data
            })
        }

        $scope.deleteColumn = function (index, data) {
            console.log(data)
            $garagoAPI.deleteColumn(index, data).then(function (res) {
                $scope.DATA = res.data
            })
        }

        $scope.onColDropComplete = function ($index, $data, $event) {
            $garagoAPI.moveColumn($index, $data, $event).then(function (res) {
                $scope.DATA = res.data
            })
        }

        $scope.onRowDropComplete = function ($index, $data, $event) {
            $garagoAPI.moveRow($index, $data, $event).then(function (res) {
                $scope.DATA = res.data
            })
        }

        $scope.onDragMove = function ($event) {
            console.log("Move: ", [$event])
        }

        $scope.toggleLock = function (item, row) {
            console.log(item, row)
            $garagoAPI.toggleLock(item).then(function (res) {
                console.log(res)
                item.DetailPlan.locked = !item.DetailPlan.locked
            })
        }

        $scope.openSettings = function () {
            $ionicSideMenuDelegate.toggleRight()
        }

        $scope.toggleEnumeration = function () {
            $scope.showEmuneration = !$scope.showEmuneration
        }

        $rootScope.createNewPlan = function () {
            $garagoAPI.newPlan().then(function (res) {
                console.log("New plan created: ", res)
                $scope.DATA = res.data
            })
        }

        $scope.showGridBottomSheet = function () {
            $scope.alert = '';
            $mdBottomSheet.show({
                templateUrl: 'templates/actionplan-admincontrols.html',
                controller: 'GridBottomSheetCtrl', ///// this controller is in this file at bottom
                clickOutsideToClose: true
            }).then(function (clickedItem) {
                // $mdToast.show(
                //     $mdToast.simple()
                //         .textContent(clickedItem['name'] + ' clicked!')
                //         .position('top right')
                //         .hideDelay(1500)
                // );
            }).catch(function (error) {
                // User clicked outside or hit escape
            });
        };

        if (initData == false) {
            $garagoAPI.newPlan().then(function (res) {
                console.log(res)
                $scope.DATA = res.data
            })
        }
    })

    .controller('GridBottomSheetCtrl', function ($scope, $mdBottomSheet, $rootScope, $ionicPopup) {
        $scope.items = [
            { name: 'Create New', icon: 'file-o' },
            { name: 'Duplicate', icon: 'clone' },
            { name: 'Delete', icon: 'times' },
            { name: 'Edit', icon: 'pencil' },
            { name: 'Lock', icon: 'lock' },
            { name: 'Share', icon: 'share' },
        ];

        $scope.listItemClick = function ($index) {
            var clickedItem = $scope.items[$index];
            if ($index == 0) {
                var confirmPopup = $ionicPopup.confirm({
                    title: 'Warning',
                    template: 'Are you sure you leave current plan?'
                });

                confirmPopup.then(function (res) {
                    if (res) {
                        console.log('You are sure');
                        $rootScope.createNewPlan()
                    } else {
                        console.log('You are not sure');
                    }
                });
            }
            $mdBottomSheet.hide(clickedItem);
        };
    })