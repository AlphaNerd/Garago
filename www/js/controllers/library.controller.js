angular.module('garago.controllers.library', [])

  .controller('LibraryCtrl', function ($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $parseAPI, userFilesData, FileUploader) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function (e) {
      console.log("LibraryCtrl Loaded.")
    });

    $scope.searchTags = []

    $scope.toggleFilters = function (data) {
      $scope.showFilters = !$scope.showFilters
    }

    $scope.userFiles = userFilesData

    $scope.searchFiles = function (search) {
      if (search.length > 0) {
        $parseAPI.searchFiles(search).then(function (res) {
          console.log("Search returned: ", res)
          $scope.searchResults = res
        })
        // $garagoAPI.searchFiles(search.toLowerCase()).then(function (res) {
        //   console.log("Search returned: ", res)
        //   $scope.searchResults = res
        // })
      } else {
        $scope.searchResults = []
      }
    }

    $scope.uploadFiles = function(){
      var $input = angular.element(document.getElementById('upload'));
      console.log($input[0].files)
      $parseAPI.saveUserFile($input[0].files,$scope.searchTags).then(function (res) {
        console.log("Save returned: ", res)
        $parseAPI.getUserFiles().then(function (res) {
          console.log("Save returned: ", res)
          $scope.userFiles = res
        })
      })
    }
  })
