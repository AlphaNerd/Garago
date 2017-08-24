angular.module('garago.controllers.actionplans', [])

  .controller('ActionPlansCtrl', function(
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
      console.log('object created');
      $scope.DATA.unshift(object)
      $scope.$apply()
    });

    ACTIONPLANS.on('update', function(object) {
      console.log('object updated', object);
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

  })
