//if user is logged in it will show a hello message with the user name
function getUserData() {
    FB.api('/me', function(response) {
        //store fb name into a session
        sessionStorage.setItem('name',response.name);
        var user = response.name;

        document.getElementById('response').innerHTML =
            'Hello ' +  user + '<br> <button id="join">join</button>';


        //add a click event to the join button and roll a random number between 1 and 4 for the rooms
        document.getElementById('join').addEventListener('click',function(){
            var x = Math.floor((Math.random()*4)+1);
            switch (x){
                case 1:

                    window.location.assign('room1.php');
                    break;
                case 2:
                    window.location.assign('room2.php');
                    break;
                case 3:
                   window.location.assign('room3.php');
                    break;
                case 4:
                    window.location.assign('room4.php');
                    break;

            }

        });


    });
}

window.fbAsyncInit = function() {
    //SDK loaded, initialize it
    FB.init({
        appId      : '469174096627150',
        xfbml      : true,
        version    : 'v2.2',
        cookie: true
    });

    //check user session and refresh it
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            //user is authorized
            document.getElementById('loginBtn').style.display = 'none';
            getUserData();
        } else {
            //user is not authorized
        }
    });
};

//load the JavaScript SDK
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

//add event listener to login button
document.getElementById('loginBtn').addEventListener('click', function() {
    //do the login
    FB.login(function(response) {
        if (response.authResponse) {
            //user just authorized your app
            document.getElementById('loginBtn').style.display = 'none';
            getUserData();
        }
    }, {scope: 'email,public_profile', return_scopes: true});
}, false);
