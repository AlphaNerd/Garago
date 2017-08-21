angular.module('garago.controllers', [])

  .controller('ParentCtrl', function($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $garagoAPI, $window) {

      // With the new view caching in Ionic, Controllers are only called
      // when they are recreated or on app start, instead of every page change.
      // To listen for when this page is active (for example, to refresh data),
      // listen for the $ionicView.enter event:
      $scope.$on('$ionicView.enter', function(e) {
        console.log("ParentCtrl Loaded.")
      });

      $scope.MENU_ACTIONPLAN = [{
          name: "Action Plans",
          class: 'columns',
          items: [{
            title: "Latest Plan",
            link: "#/app/listplan",
            class: "clock-o"
          },{
            title: "Comment",
            link: "#/app/listplan/comments",
            class: "comments-o"
          },{
            title: "Create New",
            link: "#/app/listplan/new",
            class: "plus"
          }]
        }, {
          name: "Forms",
          class: 'files-o',
          items: [{
            title: "Saved",
            link: "#/app/myforms",
            class: "floppy-o"
          }, {
            title: "Create",
            link: "#/app/newform",
            class: "plus"
          }]
        }, {
          name: "Reports",
          class: 'line-chart',
          items: [{
            title: "Charts",
            link: "#/app/myreports/charts",
            class: "pie-chart"
          }, {
            title: "Tables",
            link: "#/app/myreports/tables,",
            class: "signal"
          }, {
            title: "Custom",
            link: "#/app/myreports/custom,",
            class: "area-chart"
          }, {
            title: "Create New",
            link: "#/app/myreports/custom,",
            class: "plus"
          }]
        }, {
          name: "Projects",
          class: 'folder-o',
          items: [{
            title: "View All",
            link: "#/app/myreports/charts",
            class: "folder-open-o"
          }, {
            title: "Create new",
            link: "#/app/myreports/tables,",
            class: "plus"
          }]
        }];

        $scope.toggleGroup = function(group) {
          if ($scope.isGroupShown(group)) {
            $scope.shownGroup = null;
          } else {
            $scope.shownGroup = group;
          }
        };
        $scope.isGroupShown = function(group) {
          return $scope.shownGroup === group;
        };

        $scope.isActiveMenu = function(data) {
          if (data == $window.location.hash) {
            return true
          } else {
            return false
          }
        }

        $scope.getRandomUser = function(){
          $garagoAPI.getRandomUserImage().then(function(res){
            console.log(res)
            return res
          })
        }

      })
