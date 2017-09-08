angular.module('garago.controllers.library', [])

  .controller('LibraryCtrl', function ($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $parseAPI, userFilesData, userSharedFilesData, FileUploader, $ionicLoading) {

    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    $scope.$on('$ionicView.enter', function (e) {
      console.log("LibraryCtrl Loaded.")
    });

    $scope.search = {
      text: ""
    }
    $scope.searchTags = []

    $scope.toggleFilters = function (data) {
      $scope.showFilters = !$scope.showFilters
    }

    $scope.userFiles = userFilesData
    $scope.userSharedFiles = userSharedFilesData

    $scope.clearSearch = function(){
      $scope.search = {}
      $scope.searchResults = []
    }

    $scope.searchFiles = function (search) {
      if (search.length > 0) {
        $parseAPI.searchFiles(search).then(function (res) {
          console.log("Search returned: ", res)
          $scope.searchResults = res
        })
      } else {
        $scope.searchResults = []
      }
    }

    $scope.uploadFiles = function(){
      $ionicLoading.show({
        template: "Saving file(s)...",
        duration: 3000
      })
      var $input = angular.element(document.getElementById('upload'));
      console.log($input[0].files)
      $parseAPI.saveUserFile($input[0].files,$scope.searchTags).then(function (res) {
        console.log("Save returned: ", res)
        $parseAPI.getUserFiles().then(function (res) {
          console.log("Save returned: ", res)
          $scope.userFiles = res
          $input.val(null);
          $scope.searchTags = []
          $ionicLoading.hide()
        })
      })
    }
  })
