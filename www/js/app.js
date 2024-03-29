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
  'garago.controllers.invite',
  'garago.controllers.users',
  'garago.controllers.myuploads',
  'garago.controllers.approvals',
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
  'angularFileUpload',
  'pascalprecht.translate',
  'star-rating'
])

  .constant('$ionicLoadingConfig', {
    template: '<div>' +
    '<ion-spinner icon="lines" class="spinner-assertive"></ion-spinner>' +
    '</div>' +
    '<div>Loading View...</div>',
    duration: 1500,
  })

  .run(function ($ionicPlatform, $rootScope, $ionicSideMenuDelegate, $timeout, $state, $location, $parseAPI) {
    $ionicPlatform.ready(function () {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      window.localStorage.clear()
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

      // $rootScope.$on('$routeChangeStart', function (event) {

      //     if (!$parseAPI.isLoggedIn()) {
      //         event.preventDefault();
      //         state.go('login');
      //     }
      //     else {
      //     }

      //  });

      $rootScope.$on('$locationChangeStart', function (event, next, current) {
        // checkAuth();
      });
      
      checkAuth()

      function checkAuth(){
        var currentUser = Parse.User.current() || null;
        try{
          if (currentUser) {
            // $state.go("app.library")  
          } else {
            // show the signup or login page
            if($location.url() != "/intro"){
              console.warn("you need to login!")
              event.preventDefault();
              $state.go("login")  
            }else{
              event.preventDefault();
            }
          }
        }
        catch(e){
          console.warn(e)
        }
      }

    });
  })

  .config(function ($stateProvider, $urlRouterProvider, $mdIconProvider, $translateProvider) {
    ////// Initialize Parse
    Parse.initialize("garagoapi");
    // Parse.serverURL = 'https://garago-api-baas-dev.herokuapp.com/parse';
    Parse.serverURL = 'http://documents.garago.net:1337/parse';
    // Parse.serverURL = 'https://garago-api-baas.herokuapp.com/parse';

    /// Angular Translate
    // $locationProvider.html5Mode({
    //   enabled: true
    // });
    $translateProvider
    .translations('en', translation_en)
    .translations('fr', translation_fr)
    .preferredLanguage('en');
    $translateProvider.useSanitizeValueStrategy('sanitizeParameters');

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
                    $ionicLoading.hide()
                    return res
                  })
                } else {
                  return $parseAPI.getUsersLastActionPlan().then(function (res) {
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
                    $ionicLoading.hide()
                    return res
                  })
                } else {
                  return $parseAPI.getUsersLastProject().then(function (res) {
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
                    $ionicLoading.hide()
                    return res
                  })
                } else {
                  return $parseAPI.getUsersLastActivity().then(function (res) {
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
                return $parseAPI.getUserFiles(5).then(function (res) {
                  $ionicLoading.hide()
                  return res
                })
              },
              userSharedFilesData: function ($parseAPI, $ionicLoading) {
                $ionicLoading.show()
                return $parseAPI.getUserSharedFiles().then(function (res) {
                  $ionicLoading.hide()
                  return res
                })
              },
              userFavFilesData: function ($parseAPI, $ionicLoading) {
                $ionicLoading.show()
                return $parseAPI.getUserFavFiles().then(function (res) {
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
      ///   Route: /libraryuploads
      ///   Browse all user uploaded files. 
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.myuploads', {
        url: '/library/myuploads',
        views: {
          'menuContent': {
            templateUrl: 'templates/myuploads.html',
            controller: 'MyUploadsCtrl',
            resolve: {
              userUploads: function ($parseAPI, $ionicLoading) {
                $ionicLoading.show()
                Parse.User.current().fetch()
                return $parseAPI.getUserFiles().then(function (res) {
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
            templateUrl: 'templates/editfile.html',
            controller: 'EditFileCtrl',
            resolve: {
              fileData: function ($parseAPI, $ionicLoading, $stateParams) {
                $ionicLoading.show()
                Parse.User.current().fetch()
                return $parseAPI.getFile($stateParams.id).then(function (res) {
                  $ionicLoading.hide()
                  return res
                })
              }
            }
          }
        }
      })





      ////////////////////////////////////////////////////////////////
      //////////////// User Management - In Dev ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /invite
      ///   Invite a user by email address 
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.invite', {
        url: '/users/invite',
        views: {
          'menuContent': {
            templateUrl: 'templates/invite.html',
            controller: 'InviteCtrl',
            resolve: {
              regionData: function ($parseAPI, $ionicLoading, $stateParams) {
                return true
              }
            }
          }
        }
      })

      ////////////////////////////////////////////////////////////////
      //////////////// User Management - In Dev ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /invite
      ///   Invite a user by email address 
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.invites', {
        url: '/users/invites',
        views: {
          'menuContent': {
            templateUrl: 'templates/invites.html',
            controller: 'InvitesCtrl',
            resolve: {
              resolveData: function ($parseAPI, $ionicLoading, $stateParams) {
                return true
              }
            }
          }
        }
      })


      ////////////////////////////////////////////////////////////////
      //////////////// User Management - In Dev ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /users
      ///   Get all users in app
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.users', {
        url: '/users',
        views: {
          'menuContent': {
            templateUrl: 'templates/users.html',
            controller: 'UsersCtrl',
            resolve: {
              resolveData: function ($parseAPI, $ionicLoading, $stateParams) {
                return Parse.Cloud.run('getAllUsers',{}).then(function(res) {
                  return res
                })
              }
            }
          }
        }
      })


      ////////////////////////////////////////////////////////////////
      //////////////// NEEDS APPROVAL - In Dev ///////////////////////
      ////////////////////////////////////////////////////////////////
      ///
      ///   Route: /library/browse
      ///   Browse & Search smart library for files. 
      ///
      ////////////////////////////////////////////////////////////////
      .state('app.approvals', {
        url: '/library/approvals',
        views: {
          'menuContent': {
            templateUrl: 'templates/file_approvals.html',
            controller: 'ApprovalsCtrl',
            resolve: {
              userFilesData: function ($parseAPI, $ionicLoading) {
                $ionicLoading.show()
                Parse.User.current().fetch()
                return $parseAPI.getApprovals().then(function (res) {
                  console.log(res)
                  $ionicLoading.hide()
                  return res
                })
              }
            }
          }
        }
      })

    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/app/login');
  });
