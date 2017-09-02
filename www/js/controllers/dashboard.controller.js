angular.module('garago.controllers.dashboard', [])

    .controller('DashboardCtrl', function ($scope, $ionicModal, $timeout, $rootScope, $ionicSideMenuDelegate, $parseAPI) {

        // With the new view caching in Ionic, Controllers are only called
        // when they are recreated or on app start, instead of every page change.
        // To listen for when this page is active (for example, to refresh data),
        // listen for the $ionicView.enter event:
        $scope.$on('$ionicView.enter', function (e) {
            console.log("DashboardCtrl Loaded.")
        });

        $timeout(function () {
            // $ionicSideMenuDelegate.canDragContent(false)
            if (!$rootScope.isMobile) {
                $ionicSideMenuDelegate.toggleLeft()
            }
        }, 50)

        $scope.shouldShowDelete = false;
        $scope.shouldShowReorder = false;
        $scope.listCanSwipe = true

        $parseAPI.getUserOrganizations().then(function (res) {
            console.log("User's Organizations: ", [res])
            $scope.ORGANIZATIONS = res
        })

        $parseAPI.getUserTeams().then(function (res) {
            console.log("User's Teams: ", [res])
            $scope.TEAMS = res
        })

        $parseAPI.getAllUserProjects().then(function (res) {
            console.log("User's Projects: ", [res])
            $scope.PROJECTS = res
        })

        $scope.toggleProjectOrder = function () {
            $scope.PROJECTS.reverse()
        }

        $scope.getTotalBudget = function (projects) {
            var total = 0
            angular.forEach(projects, function (val, key) {
                total += val.attributes.total_budget
            })
            return total
        }

        $scope.pieData = [{
            name: "Jeff Test",
            y: 56.33
        }, {
            name: "Sample Project",
            y: 24.03,
            sliced: true,
            selected: true
        }, {
            name: "New Project Name",
            y: 10.38
        }, {
            name: "New Project Name",
            y: 4.77
        }, {
            name: "New Project Name",
            y: 0.91
        }]


        ////////////////////////////////////////////////////////////////
        //////// PARSE LIVE QUERY - ORGANIZATIONS ////////////////
        ////////////////////////////////////////////////////////////////
        var Organizations = Parse.Object.extend("Organizations")
        var query1 = new Parse.Query(Organizations)
        // query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Organizations)
        // query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);

        var ORGANIZATIONS = mainQuery.subscribe();

        ORGANIZATIONS.on('open', function () {
            console.log('subscription opened for ORGANIZATIONS');
        });

        ORGANIZATIONS.on('create', function (object) {
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

        ORGANIZATIONS.on('update', function (object) {
            console.log('object updated', object);
            for (i = 0; i < $scope.ORGANIZATIONS.length; i++) {
                var obj = $scope.ORGANIZATIONS[i]
                if (obj.id == object.id) {
                    obj = object
                    $scope.$apply()
                }
            }
        });

        ORGANIZATIONS.on('leave', function (object) {
            console.log('object left');
        });

        ORGANIZATIONS.on('delete', function (object) {
            console.log('object deleted');
        });

        ORGANIZATIONS.on('close', function () {
            console.log('subscription closed');
        });


        ////////////////////////////////////////////////
        //////// PARSE LIVE QUERY - TEAMS ////////////////
        ////////////////////////////////////////////////
        var Teams = Parse.Object.extend("Teams")
        var query1 = new Parse.Query(Teams)
        // query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Teams)
        // query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);

        var TEAMS = mainQuery.subscribe();

        TEAMS.on('open', function () {
            console.log('subscription opened for TEAMS');
        });

        TEAMS.on('create', function (object) {
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

        TEAMS.on('update', function (object) {
            console.log('object updated', object);
            for (i = 0; i < $scope.TEAMS.length; i++) {
                var obj = $scope.TEAMS[i]
                if (obj.id == object.id) {
                    obj = object
                    $scope.$apply()
                }
            }
        });

        TEAMS.on('leave', function (object) {
            console.log('object left');
        });

        TEAMS.on('delete', function (object) {
            console.log('object deleted');
        });

        TEAMS.on('close', function () {
            console.log('subscription closed');
        });


        ////////////////////////////////////////////////
        //////// PARSE LIVE QUERY - Projects ////////////////
        ////////////////////////////////////////////////
        var Projects = Parse.Object.extend("Projects")
        var query1 = new Parse.Query(Projects)
        // query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Projects)
        // query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);

        var PROJECTS = mainQuery.subscribe();

        PROJECTS.on('open', function () {
            console.log('subscription opened for PROJECTS');
        });

        PROJECTS.on('create', function (object) {
            console.log('object created', [object]);
            if ($scope.PROJECTS) {
                object.set("class", ["new"])
                $scope.PROJECTS.unshift(object)
                $scope.$apply()
            } else {
                $scope.PROJECTS = [object]
                $scope.$apply()
            }
        });

        PROJECTS.on('update', function (object) {
            console.log('object updated', object);
            for (i = 0; i < $scope.PROJECTS.length; i++) {
                var obj = $scope.PROJECTS[i]
                if (obj.id == object.id) {
                    obj = object
                    $scope.$apply()
                }
            }
        });

        PROJECTS.on('leave', function (object) {
            console.log('object left');
        });

        PROJECTS.on('delete', function (object) {
            console.log('object deleted');
        });

        PROJECTS.on('close', function () {
            console.log('subscription closed');
        });

    })
