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
      $scope.DATA = object
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

    $scope.createNewActionPlan = function() {
      $ionicLoading.show({
        template: '<i class="icon ion-loading-c"></i><div>Creating new Action Plan...</div>',
        duration: 1000
      })
      Parse.Cloud.run('createNewActionPlan', { 
        title: 'My New Action Plan',
        description: 'Some example description'
      }).then(function(res) {
        $scope.DATA = res
        $ionicLoading.hide()
      });
    }

    $scope.addRow = function(){
      console.log($scope.DATA)
      var columns = []
      angular.forEach($scope.DATA.attributes.columns,function(val,key){
        columns.push({
          text: "null",
          locked: false
        })
      })
      var rows = $scope.DATA.attributes.rows
      rows.push({
        title: "Axis",
        columns: columns
      })
      $scope.DATA.set("rows",rows)
      $scope.DATA.save()
    }

    $scope.deleteRow = function(index){
      var rows = $scope.DATA.attributes.rows
      rows.splice(index,1)
      $scope.DATA.set("rows",rows)
      $scope.DATA.save()
    }

    $scope.addColumn = function(){
      var columns = $scope.DATA.attributes.columns
      columns.push({
        title: "New Column",
        style: {
          "background":"#f3f3f3",
          "color":"#333"
        }
      })
      //// add extra column to rows
      var rows = []
      angular.forEach($scope.DATA.attributes.rows,function(val,key){
        var row = $scope.DATA.attributes.rows[key]
        row.columns.push({
          text: "null",
          locked: false
        })
        rows.push(row)
      })
      $scope.DATA.set("rows",rows)
      $scope.DATA.set("columns",columns)
      $scope.DATA.save()
    }

    $scope.deleteColumn = function(index){
      console.log($scope.DATA)
      //// delete a column header
      var columns = $scope.DATA.attributes.columns
      console.log(columns[index])
      var obj = columns.splice(index,1)
      //// delete corresponding rows
      var rows = []
      angular.forEach($scope.DATA.attributes.rows,function(val,key){
        var row = $scope.DATA.attributes.rows[key]
        var obj = row.columns.splice(index,1)
        rows.push(row)
      })
      $scope.DATA.set("rows",rows)
      $scope.DATA.set("columns",columns)
      $scope.DATA.save()
    }

    ///// Move Items In Array
    Array.prototype.move = function(old_index, new_index) {
      if (new_index >= this.length) {
        var k = new_index - this.length;
        while ((k--) + 1) {
          this.push(undefined);
        }
      }
      this.splice(new_index, 0, this.splice(old_index, 1)[0]);
      return this; // for testing purposes
    };

    $scope.moveColumn = function(index,data,event){
      var from = event.element[0].attributes.col.value
      var columns = $scope.DATA.attributes.columns
      columns.move(from,index)
      var rows = $scope.DATA.attributes.rows
      angular.forEach(rows,function(val,key){
        var columns = val.columns
        columns.move(from,index)
      })
      $scope.DATA.set("rows",rows)
      $scope.DATA.set("columns",columns)
      $scope.DATA.save()
    }

    $scope.moveRow = function(index,data,event){
      var from = event.element[0].attributes.row.value
      var rows = $scope.DATA.attributes.rows
      rows.move(from,index)
      $scope.DATA.set("rows",rows)
      $scope.DATA.save()
    }

    $scope.$toggleCellLock = function(item){
      item.locked = !item.locked
      $scope.DATA.save()
    }

    $scope.openSettings = function() {
      $ionicSideMenuDelegate.toggleRight()
    }

    $scope.isActivityColumn = function(index){
      angular.forEach($scope.DATA.attributes.rows.columns,function(val,key){
        console.log(val.title)
        if(val.title.toLowerCase() == "activities"){
          return true
        }else{
          return false
        }
      })
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

    if(!initData){
      var confirmPopup = $ionicPopup.confirm({
          title: 'Warning',
          template: 'You do not have any plans. Do you want to create one?'
        });

        confirmPopup.then(function(res) {
          if (res) {
              $scope.createNewActionPlan()
          } else {
            console.log('You are not sure');
            $state.go("app.dashboard")
          }
        });
      
    }

  })

  .controller('GridBottomSheetCtrl', function($scope, $mdBottomSheet, $scope, $ionicPopup) {
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
            $scope.createNewPlan()
          } else {
            console.log('You are not sure');
          }
        });
      }
      $mdBottomSheet.hide(clickedItem);
    };
  })
