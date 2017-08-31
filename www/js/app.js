angular.module('garago', [
    'ionic',
    'garago.controllers',
    'garago.controllers.login',
    'garago.controllers.actionplan',
    'garago.controllers.actionplans',
    'garago.controllers.dashboard',
    'garago.controllers.library',
    'garago.controllers.register',
    'garago.controllers.intro',
    'garago.factory.api',
    'garago.factory.mockApi',
    'garago.factory.utility',
    'garago.factory.parse',
    'garago.directives.contenteditable',
    'garago.filters.keyboardShortcut',
    'ngDraggable',
    'ngMaterial',
    'ngAnimate',
    'mdColorPicker',
    'ngDroplet',
    'akoenig.deckgrid'
  ])

  .constant('$ionicLoadingConfig', {
    template: '<div>' +
      '<ion-spinner icon="lines" class="spinner-assertive"></ion-spinner>' +
      '</div>' +
      '<div>Loading View...</div>',
    duration: 1500,
  })

  .run(function($ionicPlatform, $rootScope, $ionicSideMenuDelegate, $timeout) {
    $ionicPlatform.ready(function() {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      if (window.cordova && window.cordova.plugins.Keyboard) {
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
        cordova.plugins.Keyboard.disableScroll(true);

      }

      if (window.StatusBar) {
        // org.apache.cordova.statusbar required
        StatusBar.styleDefault();
      }

      $rootScope.isMobile = ionic.Platform.isIOS() || ionic.Platform.isAndroid();
      if (!$rootScope.isMobile) {
        $timeout(function() {
          $ionicSideMenuDelegate.toggleLeft()
        }, 100)
      }

    });
  })

  .config(function($stateProvider, $urlRouterProvider, $mdIconProvider) {
    ////// Initialize Parse
    Parse.initialize("garagoapi");
    Parse.serverURL = 'https://garago-api-baas.herokuapp.com/parse';
    ////// Angular Material Icon stuff
    $mdIconProvider
      .iconSet('social', 'img/icons/sets/social-icons.svg', 24)
      .defaultIconSet('img/icons/sets/core-icons.svg', 24);
    //////////////////////////////////////////  
    ////// Routing
    //////////////////////////////////////////////////////////////////
    $stateProvider

      ////////////////////////////////////////////////////////////////
      ///   App entry point. Parent route to all routes
      ////////////////////////////////////////////////////////////////
      .state('app', {
        url: '/app',
        abstract: true,
        templateUrl: 'templates/menu.html',
        controller: 'ParentCtrl'
      })

      ////////////////////////////////////////////////////////////////
      ///   Onboarding of users
      ////////////////////////////////////////////////////////////////
      .state('intro', {
        url: '/intro',
        templateUrl: 'templates/intro.html',
        controller: 'IntroCtrl'
      })

      ////////////////////////////////////////////////////////////////
      ///   Get more users and moola
      ////////////////////////////////////////////////////////////////
      .state('register', {
        url: '/register',
        templateUrl: 'templates/register.html',
        controller: 'RegisterUserCtrl'
      })

      ////////////////////////////////////////////////////////////////
      ///   User login provided through the Parse SDK
      ////////////////////////////////////////////////////////////////
      .state('login', {
        url: '/login',
        templateUrl: 'templates/login.html',
        controller: 'LoginCtrl'
      })

      ////////////////////////////////////////////////////////////////
      ///   Make really nice for Francis! Full stats display in a pretty way.
      ////////////////////////////////////////////////////////////////
      .state('app.dashboard', {
        url: '/dashboard',
        views: {
          'menuContent': {
            templateUrl: 'templates/dashboard.html',
            controller: 'DashboardCtrl'
          }
        }
      })

      ////////////////////////////////////////////////////////////////
      //////////////// Single Action Plan View ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /actionplan/:id
      ///   @id: If supplied will grab specific plan. If not, defaults back to lastest plan.
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.actionplan', {
        url: '/actionplan/:id',
        views: {
          'menuContent': {
            templateUrl: 'templates/actionplan.html',
            controller: 'ActionPlanCtrl',
            resolve: {
              initData: function($garagoAPI, $ionicLoading, $parseAPI, $stateParams) {
                $ionicLoading.show()
                console.info($stateParams)
                if ($stateParams.id != "") {
                  return $parseAPI.getUsersActionPlanById($stateParams.id).then(function(res) {
                    console.log("Action Plan View Resolve: ", [res])
                    $ionicLoading.hide()
                    return res
                  })
                } else {
                  return $parseAPI.getUsersLastActionPlan().then(function(res) {
                    console.log("Action Plan View Resolve: ", [res])
                    $ionicLoading.hide()
                    return res
                  })
                }
              }
            }
          }
        }
      })


      ////////////////////////////////////////////////////////////////
      //////////////// Multiple Action Plans View ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /actionplans
      ///   List all action plans which the user is either a Member or Owner of
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.actionplans', {
        url: '/actionplans',
        views: {
          'menuContent': {
            templateUrl: 'templates/actionplans.html',
            controller: 'ActionPlansCtrl',
            resolve: {
              initData: function($ionicLoading, $parseAPI) {
                $ionicLoading.show()
                return $parseAPI.getAllUserActionPlans().then(function(res) {
                  console.log("Action Plans View Resolve: ", [res])
                  $ionicLoading.hide()
                  return res
                })
              }
            }
          }
        }
      })


      ////////////////////////////////////////////////////////////////
      //////////////// Smart Library Route - In Dev ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /actionplans
      ///   List all action plans which the user is either a Member or Owner of
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.library', {
        url: '/library',
        views: {
          'menuContent': {
            templateUrl: 'templates/library.html',
            controller: 'LibraryCtrl',
            resolve: {
              userFilesData: function($garagoAPI, $mockApi, $ionicLoading) {
                $ionicLoading.show()
                return $garagoAPI.getAllUserFiles().then(function(res) {
                  console.log("Library View Resolve: ", res)
                  $ionicLoading.hide()
                  return res
                })
              }
            }
          }
        }
      })

    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/intro');
  });
