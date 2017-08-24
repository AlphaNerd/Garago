// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.controllers' is found in controllers.js
angular.module('garago', [
    'ionic',
    'garago.controllers',
    'garago.controllers.login',
    'garago.controllers.actionplan',
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
    ///// Parse DB Init
    // var ParseAppName = "GaragoApi"
    // var ParseServerURL = 'https://garago-api-baas.herokuapp.com/parse'
    // Parse.initialize(ParseAppName);
    // Parse.serverURL = ParseServerURL
    Parse.initialize("garagoapi");
    Parse.serverURL = 'https://garago-api-baas.herokuapp.com/parse';

    $mdIconProvider
      .iconSet('social', 'img/icons/sets/social-icons.svg', 24)
      .defaultIconSet('img/icons/sets/core-icons.svg', 24);

    $stateProvider

      .state('app', {
        url: '/app',
        abstract: true,
        templateUrl: 'templates/menu.html',
        controller: 'ParentCtrl'
      })

      .state('intro', {
        url: '/intro',
        templateUrl: 'templates/intro.html',
        controller: 'IntroCtrl'
      })

      .state('register', {
        url: '/register',
        templateUrl: 'templates/register.html',
        controller: 'RegisterUserCtrl'
      })

      .state('login', {
        url: '/login',
        templateUrl: 'templates/login.html',
        controller: 'LoginCtrl'
      })

      .state('app.dashboard', {
        url: '/dashboard',
        views: {
          'menuContent': {
            templateUrl: 'templates/dashboard.html',
            controller: 'DashboardCtrl'
          }
        }
      })

      .state('app.listplan', {
        url: '/listplan',
        views: {
          'menuContent': {
            templateUrl: 'templates/actionplan.html',
            controller: 'ActionPlanCtrl',
            resolve: {
              initData: function($garagoAPI, $ionicLoading) {
                $ionicLoading.show()
                return $garagoAPI.getPlan().then(function(res) {
                  console.log("Action Plan View Resolve: ", res)
                  if (res.hasOwnProperty("historical_id")) {
                    console.log("Action plan found.")
                    $ionicLoading.hide()
                    return res
                  } else {
                    return false
                    $ionicLoading.hide()
                  }
                })
              }
            }
          }
        }
      })

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
