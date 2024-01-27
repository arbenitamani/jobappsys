<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

  .profile-navbar{


            padding: 0 15px;
           
            border-bottom: 2px solid rgb(33, 33, 34);
  }        
        
        
           
        
            ul {
                padding-left: 1400px;
                list-style-type: none;
                display: flex;
            }
        
                li {
                    padding-left: 50px;
                }
        
                    a {
                        text-decoration: none;
                        font-size: 18px;
                        font-weight: 500;
                        color: black;
                    }
                
    .profile-content{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 600px;
    margin-top: 10px;
    }
  


    

        .left-1{
            display: flex;
            flex-direction: column;
        }
            h2{
                font-size: 30px;
                font-weight: 400;
            }
             img{
                border-radius: 50%;
                width: 80px;
                height: 80px;
             }
             h1{
                font-size: 25px;

             }
             p{
                margin-top: -10px;
                color: rgb(119, 122, 130);
             }
             h4{
                font-size: 20px;
                font-weight: 500;
             }
        

        .left-2{
            display: flex;
            gap: 100px;
        }

       
            h4{
                font-size: 20px;
            }
            button{
                border: 1px solid black;
                padding: 10px;
              border-radius: 15px;
                margin-left: 10px;
                margin-top: 10px;
                cursor: pointer;

            }
            button:hover{
                background-color: black;
                color: white;
            }
        

    </style>
</head>
<body>
      <div class="profile-wrapper">
            <div class="profile-navbar">
        <ul>
        <li><a>Browse</a></li>
            <li><a>Me</a></li>
        </ul>
    
            </div>

            <div class="profile-content">
                <div class="profile-left">
                    <div class="left-1">
                        <h2>My profile</h2>
                        <img src="../../../images/profile.jpg" alt="" />
                        <h1>Kira Kosmacheva</h1>
                        <p>@kirafromsea</p>
                        <h4>Front-end Developer at Xsolla, I am involved in the <br />
                            development and support of the Xsolla Design System.</h4>
                        <p>Bucharest, Romania</p>
                        <p>kirafromsea.com</p>

                    </div>
                    <div class="left-2">
                        <div class="l2">
                         <p>Followers</p>
                         <h1>117k</h1>

                        </div>
                        <div class="l2">
                        <p>Following</p>
                         <h1>363k</h1>
                        </div>
                        <div class="l2" >
                        <p>Likes</p>
                         <h1>42,739</h1>
                        </div>
                    </div>

                    <div class="left-3">
                        <h4>Skills</h4>
                        <button>Web-Development</button>
                        <button>Front End</button>
                        <button>UI Design</button>
                        <br />
                        <button>Design Systems</button>
                        <button>React.js</button>
                        <button>Redux.js</button>
                        <br />
                        <button>Product Development</button>
                    </div>
                </div>

                <div class="profile-right">
                    <div class="right-1">
                       <h2>Jobs</h2> 
                    </div>
                    <div class="right-2">

                    </div>
                </div>

            </div>

        </div>
</body>
</html>