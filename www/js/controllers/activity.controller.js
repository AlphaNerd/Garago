angular.module('garago.controllers.activity', [])

    .controller('ActivityCtrl', function (
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

        console.log("Activity Controller Loaded")

        $scope.DATA = initData
        console.log($scope.DATA)

        //////// PARSE LIVE QUERY ////////////////
        var Activities = Parse.Object.extend("Activities")
        var query1 = new Parse.Query(Activities)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Activities)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);

        var ACTIVITIES = mainQuery.subscribe();

        ACTIVITIES.on('open', function () {
            console.log('subscription opened for PROJECT');
        });

        ACTIVITIES.on('create', function (object) {
            console.log('object created', [object]);
            if ($scope.DATA) {
                object.set("class", ["new"])
                $scope.DATA.unshift(object)
                $scope.$apply()
            } else {
                $scope.DATA = [object]
                $scope.$apply()
            }
        });

        ACTIVITIES.on('update', function (object) {
            console.log('object updated', object);
            for (i = 0; i < $scope.DATA.length; i++) {
                var obj = $scope.DATA[i]
                if (obj.id == object.id) {
                    obj = object
                    $scope.$apply()
                }
            }
        });

        ACTIVITIES.on('leave', function (object) {
            console.log('object left');
        });

        ACTIVITIES.on('delete', function (object) {
            console.log('object deleted');
        });

        ACTIVITIES.on('close', function () {
            console.log('subscription closed');
        });

        ///// Move Items In Array
        Array.prototype.move = function (old_index, new_index) {
            if (new_index >= this.length) {
                var k = new_index - this.length;
                while ((k--) + 1) {
                    this.push(undefined);
                }
            }
            this.splice(new_index, 0, this.splice(old_index, 1)[0]);
            return this; // for testing purposes
        };

        $scope.deleteProject = function (myObject, index) {
            console.log(myObject)
            myObject.destroy({
                success: function (myObject) {
                    // The object was deleted from the Parse Cloud.
                    $scope.DATA.splice(index, 1)
                    console.log("deleted")
                    $ionicListDelegate.closeOptionButtons()
                    $parseAPI.getAllUserActionPlans().then(function (res) {
                        $scope.DATA = res
                    })
                },
                error: function (myObject, error) {
                    // The delete failed.
                    // error is a Parse.Error with an error code and message.
                    console.log(error)
                }
            });
        }


    })
