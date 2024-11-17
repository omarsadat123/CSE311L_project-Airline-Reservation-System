<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Home | SkySafe</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
}
.logo{
    margin: 0;
    margin-top: 10px;
    margin-left:30px;
    font-size: 30px;
    height: 30px;
    width: 180px;
    color: rgb(255, 255, 255);
}
.nav{
    display: flex;
    flex-direction: row;
    background-color: rgb(86, 78, 112);
    padding-bottom: 10px;
}
a{
    text-decoration: none;
    color: rgb(255, 255, 255);
}
.menu{
    padding: none;
    display: flex;
    justify-content: space-between;
    padding-top: 20px;
    padding-left: 30rem;
    width: 40rem;
}
.loginBtn{
    margin: 0;
   margin-left: 35rem;
   margin-top: 10px;
   padding: 0px 5px 2px 5px;
   width: 55px;
   height: 30px;
   border-radius: 25px;
   margin-right: 20px;

}
.fly{
    font-size: 50px;
    color: aliceblue;
}
h4{
    padding-left: 5px;
    color: rgba(98, 100, 100, 0.616);
}
.bg{
    background-image: url(./img/p1.jpg);
    height:20em;
    width: 100%;
}
.bodyh1{
    padding-top: 80px;
    padding-left: 30px;
}
.fly{
    padding-bottom: 5px;
}
.deals{
    padding-top: 80px;
    padding-left: 30px;
    
}
.dealContainer{
    display: flex;
    flex-direction: row;
    justify-content: center;
}
.box{
    border: 2px rgba(0, 0, 0, 0.089) solid;
    margin-top: 20px;
    margin-left: 5px;
    border-radius: 20px;
}
.trending{
    margin-left: 30px;
    padding-top: 30px;
}
.h11{
    display: flex;
    justify-content: center;
}
.hero{
    background-color: rgba(216, 214, 212, 0.623);
    padding-bottom: 50px;
}
.Airline{
    padding-top: 20px;
}
.air{
    display: flex;
    justify-content: space-evenly; align-items: center;
}
footer {
    background-color: #333;
    color: white;
    padding: 20px 0;
    
}
.f2{
    text-align: center;
    display: flex;
    justify-content:space-between;
}
.links{
    padding-right: 30px;
    display: flex;
    justify-content: space-between;
    width: 500px;
    padding-top: 10px;

}
.contact{
    padding-top: 10px;
    padding-left: 20px;
}
.copy{
    display: flex;
    justify-content: end;
    padding-right: 25px;

}

    </style>
</head>
<body>

    <div class="nav">
        <h1 class="logo">Cholo Palai</h1>
        <div class="menu">
            <a class="home" href="index.php">Home</a>
            <a class="flight" href="login.php">Flights</a>
            <a class="contact" href="contact.php">Contact Us</a>
        </div>
 
        <button class="loginBtn" onclick="window.location.href='login.php'">Login</button>
    </div>
    <div class="bg">
        <div class="bodyh1">
            <h1 class="fly">Where to Fly?</h1>
            <h4>Find Cheap Flights, Airline Tickets in Bangladesh</h4>
        </div>
    </div>
    <div class="hero">
        <div class="trending">
            <h1 class="h11">Trending destinations</h1>
            <p class="h11">Expand your travel horizons with us! 
            Diversify your journey to explore beautiful new destinations</p>
        
            <div class="dealContainer">
                <img src="./img/cox.webp" class="box" width="320" height="156" alt="">
                <img src="./img/chit.jpg" class="box" width="320" height="156" alt="">
                <img src="./img/joss.jpg" class="box" width="320" height="156" alt="">
                <img src="./img/syl.jpg" class="box" width="320" height="156" alt="">
            </div>
        </div>
        <div class="deals">
            <h1 class="h11">Top Flight Deals</h1>
            
            <div class="dealContainer">
                <img src="./img/box1.png" class="box" width="320" height="156" alt="">
                <img src="./img/box2.png" class="box" width="320" height="156" alt="">
                <img src="./img/box3.png" class="box" width="320" height="156" alt="">
            </div>
        </div>
    </div>
    <div class="Airline">
        <h1 class="h11">Most Popular Airlines</h1>
        <p class="h11">Discover top airlines on Cholo Palai and seamlessly search any flight and get any online ticket</p>
        <p class="h11">instantly, granting you effortless access to global travel.</p>
        <div class="air">
            <img src="./img/novo.png" alt="" width="180" height="auto">
            <img src="./img/us.png" alt="" width="180" height="auto">
            <img src="./img/biman.png" alt="" width="180" height="auto">
            <img src="./img/emi.png" alt="" width="180" height="auto">
        </div>
    </div>
    
    <footer>
        <div class="f2">
            <div class="contact">
                <p>Email: cholopalai@project.com</p>
                <p>Phone: +123 456 7890</p>
            </div>
        </div>
        <p class="copy">@MidhatSadatOwaes</p>
    </footer>
    
</body>
</html>
