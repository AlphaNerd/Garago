var express = require('express'),
app = express();
var bodyParser = require('body-parser');
var request = require('request');

// configure app to use bodyParser()
// this will let us get the data from a POST
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

app.use(express.static('www'));

app.set('port', process.env.PORT || 4000);

// ROUTES FOR OUR API
// =============================================================================
var router = express.Router();              // get an instance of the express Router

// test route to make sure everything is working (accessed at GET http://localhost:8080/api)
router.get('/', function(req, res) {
    res.send("API operational") 
});

app.listen(app.get('port'), function () {
    console.log('Express server listening on port ' + app.get('port'));
});

