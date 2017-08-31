angular.module('garago.controllers.actionplans', [])

  .controller('ActionPlansCtrl', function(
    $scope,
    $ionicModal,
    $timeout,
    $window,
    $rootScope,
    $ionicSideMenuDelegate,
    $garagoAPI,
    $parseAPI,
    $mockApi,
    initData,
    $mdBottomSheet,
    $mdToast,
    $ionicPopup,
    $ionicLoading,
    $ionicListDelegate) {

    console.log("Action Plan Controller Loaded")

    $scope.DATA = initData

    $scope.shouldShowDelete = false;
    $scope.shouldShowReorder = false;
    $scope.listCanSwipe = true

    //////// PARSE LIVE QUERY ////////////////
    var ActionPlans = Parse.Object.extend("ActionPlans")
    var query1 = new Parse.Query(ActionPlans)
    query1.exists("title")
    query1.exists("rows")
    query1.exists("columns")
    query1.descending("createdAt")
    query1.equalTo("members", Parse.User.current().id)

    var query2 = new Parse.Query(ActionPlans)
    query2.exists("title")
    query2.exists("rows")
    query2.exists("columns")
    query2.descending("createdAt")
    query2.equalTo("owners", Parse.User.current().id)

    var mainQuery = Parse.Query.or(query1, query2);

    var ACTIONPLANS = mainQuery.subscribe();

    ACTIONPLANS.on('open', function() {
      console.log('subscription opened for ActionPlans');
    });

    ACTIONPLANS.on('create', function(object) {
      console.log('object created',[object]);
      if($scope.DATA){
        object.set("class",["new"])
          $scope.DATA.unshift(object)
          $scope.$apply()
      }else{
        $scope.DATA = [object]
        $scope.$apply()
      }
    });

    ACTIONPLANS.on('update', function(object) {
      console.log('object updated', object);
      for(i=0;i<$scope.DATA.length;i++){
        var obj = $scope.DATA[i]
        if(obj.id == object.id){
          obj = object
          $scope.$apply()
        }
      }
    });

    ACTIONPLANS.on('leave', function(object) {
      console.log('object left');
    });

    ACTIONPLANS.on('delete', function(object) {
      console.log('object deleted');
    });

    ACTIONPLANS.on('close', function() {
      console.log('subscription closed');
    });

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

    $scope.deletePlan = function(myObject,index){
        console.log(myObject)
        myObject.destroy({
          success: function(myObject) {
            // The object was deleted from the Parse Cloud.
            $scope.DATA.splice(index,1)
            console.log("deleted")
            $ionicListDelegate.closeOptionButtons()
            $parseAPI.getAllUserActionPlans().then(function(res){
                $scope.DATA = res
            })
          },
          error: function(myObject, error) {
            // The delete failed.
            // error is a Parse.Error with an error code and message.
            console.log(error)
          }
        });
    }

    $scope.showReorder = function(){
        $scope.shouldShowReorder = !$scope.shouldShowReorder
        return $scope.shouldShowReorder
    }

    $scope.showDelete = function(){
        $scope.shouldShowDelete = !$scope.shouldShowDelete
        return $scope.shouldShowDelete
    }

    $scope.reorderItem = function(index,from,to){
      $scope.DATA.move(from,to)
      angular.forEach($scope.DATA,function(val,key){
        val.set("weight",key)
        val.save()
      })
    }

  })
