angular.module('garago.factory.parse', [])

  .factory('$parseAPI', ['$http', '$timeout', '$q', '$ionicLoading', '$rootScope', '$state', function($http, $timeout, $q, $ionicLoading, $rootScope, $state) {
    Array.prototype.move = function(old_index, new_index) {
      if (new_index >= this.length) {
        var k = new_index - this.length;
        while ((k--) + 1) {
          this.push(undefined);
        }
      }
      this.splice(new_index, 0, this.splice(old_index, 1)[0]);
      return this; // for testing purposes
    };
    function handleParseError(err) {
      switch (err.code) {
        case Parse.Error.INVALID_SESSION_TOKEN:
          Parse.User.logOut();
          $state.go("login")
          break;
      }
    }
    var ActionPlans = Parse.Object.extend("ActionPlans")
    var Messages = Parse.Object.extend("Messages")
    var Organizations = Parse.Object.extend("Organizations")
    var Teams = Parse.Object.extend("Teams")
    var Projects = Parse.Object.extend("Projects")
    var Activities = Parse.Object.extend("Activities")
    var Files = Parse.Object.extend("Files")
    var Users = Parse.Object.extend("User")

    var obj = {
      ////////////////////////////////////////////////
      ////// Get all projects the current user is a member or owner of
      ////////////////////////////////////////////////
      getAllUserProjects: function(){
        var deferred = $q.defer()

        var query1 = new Parse.Query(Projects)
        query1.exists("total_budget")
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Projects)
        query2.exists("total_budget")
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.descending("total_budget")
        mainQuery.find({
          success: function(res) {
            console.log("Found user's projects: ", [res[0]])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res)
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get a specific Project by ID
      ////////////////////////////////////////////////
      getUsersProjectById: function(id) {
        var deferred = $q.defer()
        var query = new Parse.Query(Projects)
        query.equalTo("objectId",id)
        query.find({
          success: function(res) {
            console.log("Found Project by ID: ", [res[0]])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res[0])
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get the current user's most recent project
      ////////////////////////////////////////////////
      getUsersLastProject: function() {
        var deferred = $q.defer()
        var query1 = new Parse.Query(Projects)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Projects)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.descending("updatedAt")
        mainQuery.limit(1)
        mainQuery.find({
          success: function(res) {
            console.log("Found latest Project: ", [res[0]])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res[0])
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get all activities the current user is a member or owner of
      ////////////////////////////////////////////////
      getAllUserActivities: function(){
        var deferred = $q.defer()

        var query1 = new Parse.Query(Activities)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Activities)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.find({
          success: function(res) {
            console.log("Found user's activities: ", [res[0]])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res)
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get a specific Activity by ID
      ////////////////////////////////////////////////
      getUsersActivityById: function(id) {
        var deferred = $q.defer()
        var query = new Parse.Query(Activities)
        query.equalTo("objectId",id)
        query.find({
          success: function(res) {
            console.log("Found Activity by ID: ", [res[0]])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res[0])
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get the current user's most recent Activity
      ////////////////////////////////////////////////
      getUsersLastActivity: function() {
        var deferred = $q.defer()
        var query1 = new Parse.Query(Activities)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Activities)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.descending("updatedAt")
        mainQuery.limit(1)
        mainQuery.find({
          success: function(res) {
            console.log("Found latest activity: ", [res[0]])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res[0])
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get all organizations the current user is a member or owner of
      ////////////////////////////////////////////////
      getUserOrganizations: function(data){
        var deferred = $q.defer()

        var query1 = new Parse.Query(Organizations)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Organizations)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.find({
          success: function(res) {
            console.log("Found user's organizations: ", [res[0]])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res)
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get all teams the current user is a member or owner of
      ////////////////////////////////////////////////
      getUserTeams: function(data){
        var deferred = $q.defer()

        var query1 = new Parse.Query(Teams)
        query1.equalTo("members", Parse.User.current().id)

        var query2 = new Parse.Query(Teams)
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.find({
          success: function(res) {
            console.log("Found user's teams: ", [res[0]])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res)
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get the current user's most recent action plan
      ////////////////////////////////////////////////
      getUsersLastActionPlan: function() {
        var deferred = $q.defer()
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
        mainQuery.descending("createdAt")
        mainQuery.limit(1)
        mainQuery.find({
          success: function(res) {
            console.log("Found latest Action Plan: ", [res[0]])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res[0])
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get all of the current user's action plans where they are either
      ////// the Owner or Member
      ////////////////////////////////////////////////
      getAllUserActionPlans: function() {
        var deferred = $q.defer()        
        var query1 = new Parse.Query(ActionPlans)
        query1.exists("title")
        query1.exists("rows")
        query1.exists("columns")
        query1.descending("createdAt")
        query1.contains("members", Parse.User.current().id)
        
        var query2 = new Parse.Query(ActionPlans)
        query2.exists("title")
        query2.exists("rows")
        query2.exists("columns")
        query2.descending("createdAt")
        query2.equalTo("owners", Parse.User.current().id)

        var mainQuery = Parse.Query.or(query1, query2);
        // query1.ascending("weight")

        mainQuery.find({
          success: function(res) {
            console.log("Found All User Action Plans: ", [res])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res)
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
        
      },
      ////////////////////////////////////////////////
      ////// Get a specific Action Plan by ID
      ////////////////////////////////////////////////
      getUsersActionPlanById: function(id) {
        var deferred = $q.defer()
        var query = new Parse.Query(ActionPlans)
        query.equalTo("objectId",id)
        query.find({
          success: function(res) {
            console.log("Found Action Plan: ", [res[0]])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res[0]) {
            deferred.resolve(res[0])
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get all user's messages
      ////////////////////////////////////////////////
      getUserMessages: function(res){
        var deferred = $q.defer()
        var query1 = new Parse.Query(Messages)
        query1.equalTo("sentFrom", Parse.User.current())

        var query2 = new Parse.Query(Messages)
        query2.equalTo("sentTo", Parse.User.current())

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.descending("createdAt")
        mainQuery.limit(10)
        mainQuery.include("sentTo")
        mainQuery.include("sentFrom")
        mainQuery.find({
          success: function(res) {
            console.log("Found User Messages: ", [res])
          },
          error: function(e, r) {
            handleParseError(e)
          }
        }).then(function(res) {
          if (res) {
            deferred.resolve(res)
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Save User File to Parse
      ////////////////////////////////////////////////
      saveUserFile: function(files,tags){
        var deferred = $q.defer()
        var promises = Object.keys(files).map(function(Key,Index){
          var val = files[Key]
          var promise = new Promise(function(resolve,reject){
            var parseFile = new Parse.File(val.name, val);
            parseFile.save().then(function() {
    
              var file = new Parse.Object("Files");
              file.set("file", parseFile);
              file.set("active", true);
              console.log("TAGS IN: ",tags)
              var tagArray = tags.map(function (item) {
                var obj = {
                  title: item.attributes.title,
                  noc: item.attributes.noc
                }
                return obj
              });
              file.set("tags",tagArray)
              var acl = new Parse.ACL();
              acl.setPublicReadAccess(true);
              acl.setPublicWriteAccess(false);
              acl.setWriteAccess(Parse.User.current().id, true);
              file.setACL(acl)
    
              file.save({
                success: function(res){
                  resolve(res)
                },
                error: function(e,r){
                  reject({e,r})
                }
              });
              // The file has been saved to Parse.
            }, function(error) {
              reject(error)
              // The file either could not be read, or could not be saved to Parse.
            });
          })
          return promise
        })
        
        Promise.all(promises).then(function(res){
          deferred.resolve(res) 
        }).catch(function(error){
          console.log(error)
          deferred.reject(error) 
        })

        return deferred.promise        
      },
      ////////////////////////////////////////////////
      ////// Save User File to Parse
      ////////////////////////////////////////////////
      deleteUserFile: function(file){
        var deferred = $q.defer()
        var query = new Parse.Query(Files)
        query.equalTo("objectId",file.id)
        query.find({
          success: function(res){
            console.log("FOUND FILE TO DELETE: ",res)
          },
          error: function(e,r){
            handleParseError(e)
          }
        }).then(function(res){
          res[0].set("active",false)
          res[0].save({
            success: function(resp){
              console.log("Changed Active to InActive: ", resp)
              deferred.resolve(resp)
            },
            error: function(e,r){
              handleParseError(e)
            }
          })
        })
        return deferred.promise        
      },
      ////////////////////////////////////////////////
      ////// Get ALL Public Files from Parse
      ////////////////////////////////////////////////
      getAllFiles: function(){
        var deferred = $q.defer()
        var query = new Parse.Query(Files)
        query.exists("file")
        query.equalTo("active",true)
        query.include("comments")
        query.descending("updatedAt")
        query.find({
          success: function(res) {
            console.log("Found All Files: ", [res])
          },
          error: function(e, r) {
            console.log(e, r)
            handleParseError(e)
          }
        }).then(function(resp) {
          if (resp) {
            var promises = []
            var files = []
            angular.forEach(resp,function(val,key){
              var obj = {
                id: val.id,
                attributes: val.attributes,
                comments: []
              }
              var promise = new Promise(function(resolve,reject){
                val.get("comments").query().find().then(function(res){
                  obj.comments = res
                  files[key] = obj
                  resolve(res)
                })
              })
              promises.push(promise)
            })
            Promise.all(promises).then(function(res){
              console.log("All Files: ",files)
              deferred.resolve(files)
            })
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get All User Files from Parse
      ////////////////////////////////////////////////
      getUserFiles: function(){
        var deferred = $q.defer()
        var query = new Parse.Query(Files)
        query.equalTo("createdByUser", Parse.User.current())
        query.equalTo("active",true)
        query.descending("updatedAt")
        query.limit(5)
        query.find({
          success: function(res) {
            console.log("Found User Files: ", [res])
          },
          error: function(e, r) {
            console.log(e, r)
            handleParseError(e)
          }
        }).then(function(resp) {
          if (resp) {
            var promises = []
            var files = []
            angular.forEach(resp,function(val,key){
              var obj = angular.copy(val.attributes)
              obj.id = val.id
              var promise = new Promise(function(resolve,reject){
                var query = new Parse.Query(Users)
                query.equalTo("objectId",val.attributes.createdBy)
                query.find().then(function(res){
                  console.log(res)
                  obj.members = res
                  files.push(obj)
                  resolve(res)
                })
              })
              promises.push(promise)
            })
            Promise.all(promises).then(function(res){
              console.log("Users for file: ",files)
              deferred.resolve(files)
            })
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      getUserFavFiles: function(limit){
        var deferred = $q.defer()
        var query = new Parse.Query(Files)
        query.containedIn("objectId",Parse.User.current().attributes.fav_files)
        query.limit(limit ? limit : 20)
        query.equalTo("active",true)
        query.find().then(function(resp) {
          if (resp) {
            deferred.resolve(resp)
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get All User Shared Files from Parse
      ////////////////////////////////////////////////
      getUserSharedFiles: function(){
        var deferred = $q.defer()
        var query1 = new Parse.Query(Files)
        query1.exists("owners")

        var query2 = new Parse.Query(Files)
        query2.exists("members")

        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.equalTo("createdByUser", Parse.User.current())
        
        mainQuery.descending("createdAt")
        mainQuery.limit(5)
        mainQuery.include("members")
        mainQuery.find({
          success: function(res) {
            console.log("Found User Shared Files: ", [res])
          },
          error: function(e, r) {
            console.log(e, r)
            handleParseError(e)
          }
        }).then(function(resp) {
          if (resp) {
            var promises = []
            var files = []
            angular.forEach(resp,function(val,key){
              var obj = angular.copy(val.attributes)
              obj.id = val.id
              var promise = new Promise(function(resolve,reject){
                var query = new Parse.Query(Users)
                query.containedIn("objectId",val.attributes.members)
                query.find().then(function(res){
                  console.log(res)
                  obj.members = res
                  files.push(obj)
                  resolve(res)
                })
              })
              promises.push(promise)
            })
            Promise.all(promises).then(function(res){
              console.log("Users for file: ",files)
              deferred.resolve(files)
            })
          } else {  
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Search User Files on Parse
      ////////////////////////////////////////////////
      searchFiles: function(search){
        var deferred = $q.defer()

        var query1 = new Parse.Query(Files)
        query1.contains("title", search.toLowerCase())

        var query2 = new Parse.Query(Files)
        query2.startsWith("tags", search.toLowerCase())
        
        var mainQuery = Parse.Query.or(query1, query2);
        mainQuery.equalTo("active",true)
        mainQuery.descending("updatedAt")


        mainQuery.find({
          success: function(res) {
            console.log("Found User Search Files: ", [res])
          },
          error: function(e, r) {
            console.log(e, r)
            handleParseError(e)
          }
        }).then(function(res) {
          if (res) {
            var promises = []
            var files = []
            angular.forEach(res,function(val,key){
              var obj = angular.copy(val.attributes)
              obj.id = val.id
              var promise = new Promise(function(resolve,reject){
                var query = new Parse.Query(Users)
                query.equalTo("objectId",val.attributes.createdBy)
                query.find().then(function(res){
                  console.log(res)
                  obj.members = res
                  files.push(obj)
                  resolve(res)
                })
              })
              promises.push(promise)
            })
            Promise.all(promises).then(function(res){
              console.log("Users for file: ",files)
              deferred.resolve(files)
            })
          } else {
            deferred.resolve(false)
          }
        })
        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get User Data From ID
      ////////////////////////////////////////////////
      getUsersByIDs: function(ids){
        var deferred = $q.defer()

        Parse.Cloud.run('getUsersByIDs', { 
          ids: ids
        }).then(function(res) {
          deferred.resolve(res)
        });

        return deferred.promise
      },
      ////////////////////////////////////////////////
      ////// Get User Data From ID
      ////////////////////////////////////////////////
      getFile: function(id){
        console.log(id)
        var deferred = $q.defer()
        var query = new Parse.Query(Files)
        query.equalTo("active",true)
        query.equalTo("objectId",id).find({
          success: function(res){
            console.log(res)
          },
          error: function(e,r){
            console.log(e,r)
            handleParseError(e)
          }
        }).then(function(res){
          deferred.resolve(res[0])
        })
        return deferred.promise
      },
    }
    return obj
  }])
