angular.module('garago.controllers.actionplan', [])

  .controller('ActionPlanCtrl', function(
    $scope,
    $ionicModal,
    $timeout,
    $window,
    $rootScope,
    $ionicSideMenuDelegate,
    $garagoAPI,
    $mockApi,
    initData,
    $mdBottomSheet,
    $mdToast,
    $ionicPopup) {

    console.log("Action Plan Controller Loaded")

    $rootScope.DATA = initData

    $scope.reportTitle = $garagoAPI.getReportTitle()

    $scope.showEmuneration = false

    $scope.themeData = $garagoAPI.getTheme()

    /// Toggle Document Lock
    $scope.docLock = false;
    $scope.docLockToggle = function(obj) {
        if(!obj){
            var confirmPopup = $ionicPopup.confirm({
                title: 'Warning',
                template: 'Are you sure you want to lock this plan? This cannot be undone without Admin Access'
              });

              confirmPopup.then(function(res) {
                if (res) {
                    $scope.docLock = !$scope.docLock
                    $scope.FINALIZED = new Date()
                    console.log($scope.docLock)
                } else {
                  console.log('You are not sure');
                }
              });
        }else{
            $scope.docLock = !$scope.docLock
            $scope.FINALIZED = ''
            console.log($scope.docLock)
        }
    }

    /// resfresh RESTful data
    function refresh() {
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

    /////////////////////////////
    /////// Subscriptions ///////
    /////////////////////////////
    var ActionPlans = Parse.Object.extend("ActionPlans");
    var query = new Parse.Query('ActionPlans');
    query.equalTo("users",Parse.User.current())
    
    var ACTIONPLANS = query.subscribe();
    ACTIONPLANS.on('open', () => {
     console.log('subscription opened');
    });
    ACTIONPLANS.on('update', () => {
     console.log('subscription updated');
    });

    $rootScope.createNewPlan = function() {
      var newPlan = new ActionPlans()
      newPlan.set("data",{test:"message"})
      newPlan.save({
        success: function(res){
          console.info(res)
        },
        error: function(e,r){
          console.warn(e,r)
        }
      })
      // $garagoAPI.newPlan().then(function(res) {
      //   console.log("New plan created: ", res)
      //   $scope.DATA = res.data
      // })
    }


    ///// Calculate Activity Column Position
    $scope.locateActivitiesColumn = function(data) {
      var obj = data ? data : $scope.DATA
      angular.forEach(obj.typePlan, function(val, key) {
        if (val.TypePlan.description == "Activities") {
          $scope.activityColumn = key
        }
      })
    }
    $scope.locateActivitiesColumn()

    $scope.addColumn = function(index, data) {
      $garagoAPI.addColumn(data).then(function(res) {
        $scope.DATA = res.data
      })
    }

    $scope.addRow = function(data) {
      $garagoAPI.addRow(data).then(function(res) {
        $scope.DATA = res.data
      })
    }

    $scope.deleteRow = function(index, obj) {
      $garagoAPI.deleteRow(index, obj).then(function(res) {
        $scope.DATA = res.data
      })
    }

    $scope.deleteColumn = function(index, data) {
      console.log(data)
      $garagoAPI.deleteColumn(index, data).then(function(res) {
        $scope.DATA = res.data
      })
    }

    $scope.onColDropComplete = function($index, $data, $event) {
      $garagoAPI.moveColumn($index, $data, $event).then(function(res) {
        $scope.DATA = res.data
      })
    }

    $scope.onRowDropComplete = function($index, $data, $event) {
      $garagoAPI.moveRow($index, $data, $event).then(function(res) {
        $scope.DATA = res.data
      })
    }

    $scope.onDragMove = function($event) {
      console.log("Move: ", [$event])
    }

    $scope.toggleLock = function(item, row) {
      console.log(item, row)
      $garagoAPI.toggleLock(item).then(function(res) {
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

    $scope.showGridBottomSheet = function() {
      $scope.alert = '';
      $mdBottomSheet.show({
        templateUrl: 'templates/actionplan-admincontrols.html',
        controller: 'GridBottomSheetCtrl', ///// this controller is in this file at bottom
        clickOutsideToClose: true
      }).then(function(clickedItem) {
        // $mdToast.show(
        //     $mdToast.simple()
        //         .textContent(clickedItem['name'] + ' clicked!')
        //         .position('top right')
        //         .hideDelay(1500)
        // );
      }).catch(function(error) {
        // User clicked outside or hit escape
      });
    };

    $ionicModal.fromTemplateUrl('templates/modals/new-project.html', {
      scope: $scope,
      animation: 'slide-in-up'
    }).then(function(modal) {
      $scope.newProjectModal = modal;
    });
    $scope.openModal = function() {
      $scope.newProjectModal.show();
    };
    $scope.closeModal = function() {
      $scope.newProjectModal.hide();
    };
    // Cleanup the modal when we're done with it!
    $scope.$on('$destroy', function() {
      $scope.newProjectModal.remove();
    });
    // Execute action on hide modal
    $scope.$on('newProjectModal.hidden', function() {
      // Execute action
    });
    // Execute action on remove modal
    $scope.$on('newProjectModal.removed', function() {
      // Execute action
    });

    if (initData == false) {
      $garagoAPI.newPlan().then(function(res) {
        console.log(res)
        $scope.DATA = res.data
      })
    }
  })

  .controller('GridBottomSheetCtrl', function($scope, $mdBottomSheet, $rootScope, $ionicPopup) {
    $scope.items = [
      { name: 'Create New', icon: 'file-o' },
      { name: 'Duplicate', icon: 'clone' },
      { name: 'Delete', icon: 'times' },
      { name: 'Edit', icon: 'pencil' },
      { name: $scope.docLock ? 'Unlock':'Lock', icon: $scope.docLock ? 'lock':'unlock' },
      { name: 'Share', icon: 'share' },
    ];

    $scope.listItemClick = function($index) {
      var clickedItem = $scope.items[$index];
      if ($index == 0) {
        var confirmPopup = $ionicPopup.confirm({
          title: 'Warning',
          template: 'Are you sure you leave current plan?'
        });

        confirmPopup.then(function(res) {
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
