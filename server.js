var express = require('express'),
app = express();
var bodyParser = require('body-parser');
var request = require('request');
var fs = require('fs');
var cheerio = require('cheerio');

// configure app to use bodyParser()
// this will let us get the data from a POST
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

app.use(express.static('www'));

app.set('port', process.env.PORT || 4000);

// ROUTES FOR OUR API
// =============================================================================
var router = express.Router();              // get an instance of the express Router
app.use(router) 
// test route to make sure everything is working (accessed at GET http://localhost:8080/api)

router.get('/filesearch/:search', function(req, res) {
    fs.readdir('./docs', function(err, files) {
        console.log("Files in directory ./docs/:",files)
        var promises = []
        var myArray = []
        var $
        files
            .filter(function(file) { 
                 return file.substr(-5) === '.html'; 
            })
            .forEach(function(file,key) { 
                var promise = new Promise(function(resolve,reject){
                    fs.readFile("./docs/"+file, 'utf-8', function(err, contents) { 
                        if(err){
                            console.log("Error: ",err)
                        }else{
                            console.log("Search String: ",req.params["search"])
                            var search = req.params["search"]
                            var body = contents.toLowerCase()
                            if (body.indexOf(req.params["search"]) != -1) {
                                // do something
                                console.log("Found file that contains string: ",search)
                                $ = cheerio.load(contents)
                                var stats = fs.statSync("./docs/"+file);
                                var mtime = new Date(stats.mtime);
                                console.log(mtime);
                                myArray.push({
                                    file_name: files[key],
                                    modified: mtime,
                                    title: $('.title').text(),
                                    description: $('.description').text(),
                                    download: $('.url').text()
                                })
                                resolve()
                            }else{
                                console.log("Did not find: ",search+"")
                                resolve()
                            }
                        }
                    }); 
                })
                promises.push(promise)
            })
        Promise.all(promises).then(function(res){
            console.log("ALL: ",myArray)
            success(myArray)
        })
    });
    function success(data){
        res.json(data)
    }
});

router.get('/', function(req, res) {
    res.send("API operational") 
});

app.listen(app.get('port'), function () {
    console.log('Express server listening on port ' + app.get('port'));
});

