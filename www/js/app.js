angular.module('garago', [
  'ionic',
  'garago.controllers',
  'garago.controllers.login',
  'garago.controllers.actionplan',
  'garago.controllers.actionplans',
  'garago.controllers.dashboard',
  'garago.controllers.library',
  'garago.controllers.library_browse',
  'garago.controllers.library_favs',
  'garago.controllers.register',
  'garago.controllers.intro',
  'garago.controllers.projects',
  'garago.controllers.project',
  'garago.controllers.activity',
  'garago.controllers.activities',
  'garago.controllers.editfile',
  'garago.factory.api',
  'garago.factory.mockApi',
  'garago.factory.utility',
  'garago.factory.parse',
  'garago.directives.contenteditable',
  'garago.directives.piechart',
  'garago.filters.keyboardShortcut',
  'garago.filters.utilities',
  'ngDraggable',
  'ngMaterial',
  'ngAnimate',
  'mdColorPicker',
  'ngDroplet',
  'akoenig.deckgrid',
  'angularFileUpload'
])

  .constant('$ionicLoadingConfig', {
    template: '<div>' +
    '<ion-spinner icon="lines" class="spinner-assertive"></ion-spinner>' +
    '</div>' +
    '<div>Loading View...</div>',
    duration: 1500,
  })

  .run(function ($ionicPlatform, $rootScope, $ionicSideMenuDelegate, $timeout, $state) {
    $ionicPlatform.ready(function () {
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
        $timeout(function () {
          $ionicSideMenuDelegate.toggleLeft()
        }, 100)
      }

      $rootScope.$on('$locationChangeStart', function (event, next, current) {
        console.log(next)
        // checkAuth();
      });
      
      checkAuth()

      function checkAuth(){
        var currentUser = Parse.User.current();
        if (currentUser) {
          console.log("Welcome back: ",[currentUser])
        } else {
          // show the signup or login page
          console.warn("you need to login!")
          event.preventDefault();
          $state.go("login")
        }
      }

    });
  })

  .config(function ($stateProvider, $urlRouterProvider, $mdIconProvider) {
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
              initData: function ($garagoAPI, $ionicLoading, $parseAPI, $stateParams) {
                $ionicLoading.show()
                console.info($stateParams)
                if ($stateParams.id != "") {
                  return $parseAPI.getUsersActionPlanById($stateParams.id).then(function (res) {
                    console.log("Action Plan View Resolve: ", [res])
                    $ionicLoading.hide()
                    return res
                  })
                } else {
                  return $parseAPI.getUsersLastActionPlan().then(function (res) {
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
              initData: function ($ionicLoading, $parseAPI) {
                $ionicLoading.show()
                return $parseAPI.getAllUserActionPlans().then(function (res) {
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
      //////////////// Single Project View ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /project/:id
      ///   @id: If supplied will grab specific project. If not, defaults back to lastest plan.
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.project', {
        url: '/project/:id',
        views: {
          'menuContent': {
            templateUrl: 'templates/project.html',
            controller: 'ProjectCtrl',
            resolve: {
              initData: function ($garagoAPI, $ionicLoading, $parseAPI, $stateParams) {
                $ionicLoading.show()
                console.info($stateParams)
                if ($stateParams.id != "") {
                  return $parseAPI.getUsersProjectById($stateParams.id).then(function (res) {
                    console.log("Project View Resolve: ", [res])
                    $ionicLoading.hide()
                    return res
                  })
                } else {
                  console.log("no id supplied. Getting latest")
                  return $parseAPI.getUsersLastProject().then(function (res) {
                    console.log("Project View Resolve: ", [res])
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
      //////////////// Multiple Projects View ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /projects
      ///   List all projects which the user is either a Member or Owner of
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.projects', {
        url: '/projects',
        views: {
          'menuContent': {
            templateUrl: 'templates/projects.html',
            controller: 'ProjectsCtrl',
            resolve: {
              initData: function ($ionicLoading, $parseAPI) {
                $ionicLoading.show()
                return $parseAPI.getAllUserProjects().then(function (res) {
                  console.log("Projects List View Resolve: ", [res])
                  $ionicLoading.hide()
                  return res
                })
              }
            }
          }
        }
      })

      ////////////////////////////////////////////////////////////////
      //////////////// Single activity View ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /activity/:id
      ///   @id: If supplied will grab specific activity. If not, defaults back to lastest plan.
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.activity', {
        url: '/activity/:id',
        views: {
          'menuContent': {
            templateUrl: 'templates/activity.html',
            controller: 'ActivityCtrl',
            resolve: {
              initData: function ($garagoAPI, $ionicLoading, $parseAPI, $stateParams) {
                $ionicLoading.show()
                console.info($stateParams)
                if ($stateParams.id != "") {
                  return $parseAPI.getUsersActivityById($stateParams.id).then(function (res) {
                    console.log("activity View Resolve: ", [res])
                    $ionicLoading.hide()
                    return res
                  })
                } else {
                  console.log("no id supplied. Getting latest")
                  return $parseAPI.getUsersLastActivity().then(function (res) {
                    console.log("activity View Resolve: ", [res])
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
      //////////////// Multiple Projects View ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /projects
      ///   List all projects which the user is either a Member or Owner of
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.activities', {
        url: '/activities',
        views: {
          'menuContent': {
            templateUrl: 'templates/activities.html',
            controller: 'ActivitiesCtrl',
            resolve: {
              initData: function ($ionicLoading, $parseAPI) {
                $ionicLoading.show()
                return $parseAPI.getAllUserActivities().then(function (res) {
                  console.log("activities List View Resolve: ", [res])
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
      ///   Route: /library
      ///   Searchable smart library for files. 
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.library', {
        url: '/library',
        views: {
          'menuContent': {
            templateUrl: 'templates/library.html',
            controller: 'LibraryCtrl',
            resolve: {
              userFilesData: function ($parseAPI, $ionicLoading) {
                $ionicLoading.show()
                return $parseAPI.getUserFiles().then(function (res) {
                  console.log("Library View 'User Files' Resolve: ", res)
                  $ionicLoading.hide()
                  return res
                })
              },
              userSharedFilesData: function ($parseAPI, $ionicLoading) {
                $ionicLoading.show()
                return $parseAPI.getUserSharedFiles().then(function (res) {
                  console.log("Library View 'User Shared Files' Resolve: ", res)
                  $ionicLoading.hide()
                  return res
                })
              },
              userFavFilesData: function ($parseAPI, $ionicLoading) {
                $ionicLoading.show()
                return $parseAPI.getUserFavFiles().then(function (res) {
                  console.log("Library View 'User Fav Files' Resolve: ", res)
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
      ///   Route: /library/browse
      ///   Browse & Search smart library for files. 
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.library_browse', {
        url: '/library/browse',
        views: {
          'menuContent': {
            templateUrl: 'templates/library_browse.html',
            controller: 'LibraryBrowseCtrl',
            resolve: {
              userFilesData: function ($parseAPI, $ionicLoading) {
                $ionicLoading.show()
                Parse.User.current().fetch()
                return $parseAPI.getAllFiles().then(function (res) {
                  console.log("Library Browse View 'All Files' Resolve: ", res)
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
      ///   Route: /library/favorites
      ///   Browse & Search smart library for files. 
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.library_favs', {
        url: '/library/favs',
        views: {
          'menuContent': {
            templateUrl: 'templates/library_favs.html',
            controller: 'LibraryFavsCtrl',
            resolve: {
              userFilesData: function ($parseAPI, $ionicLoading) {
                $ionicLoading.show()
                Parse.User.current().fetch()
                return $parseAPI.getUserFavFiles().then(function (res) {
                  console.log("Library Favorites View 'Fav Files' Resolve: ", res)
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
      ///   Route: /library/edit/file/:id
      ///   Edit specific file by Id. 
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.edit_file', {
        url: '/library/edit/file/:id',
        views: {
          'menuContent': {
            templateUrl: 'templates/editFile.html',
            controller: 'EditFileCtrl',
            resolve: {
              fileData: function ($parseAPI, $ionicLoading, $stateParams) {
                $ionicLoading.show()
                console.log("Edit file: ", $stateParams)
                Parse.User.current().fetch()
                return $parseAPI.getFile($stateParams.id).then(function (res) {
                  console.log("Library 'Edit File' Resolve: ", res)
                  $ionicLoading.hide()
                  return res
                })
              }
            }
          }
        }
      })

    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/app/library');
  });
