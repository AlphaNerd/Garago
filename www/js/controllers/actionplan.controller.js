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
    $ionicPopup,
    $ionicLoading) {

    console.log("Action Plan Controller Loaded")

    ///// Initial Data loaded via Route Resolve in app.js
    $scope.DATA = initData

    //////// PARSE LIVE QUERY ////////////////
    var ActionPlans = Parse.Object.extend("ActionPlans")
    var query1 = new Parse.Query(ActionPlans)
    query1.equalTo("objectId", $scope.DATA.id)
    query1.equalTo("members",Parse.User.current().id)

    var query2 = new Parse.Query(ActionPlans)
    query2.equalTo("objectId",$scope.DATA.id)
    query2.equalTo("owners",Parse.User.current().id)

    var mainQuery = Parse.Query.or(query1, query2);

    var ACTIONPLAN = mainQuery.subscribe();

    ACTIONPLAN.on('open', function() {
     console.log('subscription opened for ActionPlan');
    });

    ACTIONPLAN.on('update', function(object) {
      console.log('object updated', object);
      $rootScope.DATA = object
      $scope.$apply()
    });

    ACTIONPLAN.on('leave', function(object) {
      console.log('object left');
    });

    ACTIONPLAN.on('delete', function(object) {
      console.log('object deleted');
    });

    ACTIONPLAN.on('close', function() {
      console.log('subscription closed');
    });

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

    $scope.openSettings = function() {
      $ionicSideMenuDelegate.toggleRight()
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
      $scope.createNewActionPlan()
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
