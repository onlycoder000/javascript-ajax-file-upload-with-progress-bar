<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    print_r($_POST);
    die();
}
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }
        body{
            background: rgba(0,0,0,0.12);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .popup{
            background: white;
            width: 400px;
            height: 240px;
            padding: 15px;
            border-radius: 16px;
            position: relative;
        }
        p{
            text-align: center;
        }
        .file_cn{
            width: 100%;
            height: 100px;
            /* background: rgba(0,0,0,0.12); */
            border: 1px solid rgba(0,0,0,0.12);
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            color: red;
            font-weight: bold;
            font-style: italic;
            padding: 4px;
        }
        .sub_file_cn{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px dashed red;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        button{
            background: dodgerblue;
            color: white;
            border: none;
            width: 80px;
            height: 30px;
            margin: 0px auto;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
            text-transform: uppercase;
            display: block;
            

        }
        button:hover{
            opacity: 0.8;
        }
        input{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0px;
            cursor: pointer;
            opacity: 0;
        }
        .footer{
            font-size: 0.8em;
            font-style: italic;
            text-align: center;
            position: absolute;
            bottom: 6px;
            width: 100%;
            left: 0px;
            color:rgb(165, 165, 165);
            height: 25px;
        
        }
        .footer a{
            font-style:normal;
            letter-spacing: 1px;
            font-weight: bold;
            color:red;
            text-decoration: none;
            text-transform: uppercase;
        }
        .prg_cn{
            width: 100%;
            height: 26px;
            background-color: rgba(0,0,0,0.07);
            margin-top: 18px;
            position: relative;
        }
        .prg_text{
            color: red;
            font-weight: bold;
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-shadow: 0px 0px 6px white;
        }
        .prg_text span{
            background: rgba(255,255,255,0.6);
            height: 100%;
            padding: 0px 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .prg_fill{
            height: 100%;
            width: 0%;
            background: red;
        }
    </style>
</head>
<body>
    <div class="popup">
        <form >
            <div class="file_cn">
                <input type="file" id="fl">
                <input type="hidden" id="nav_data" value=''>
                <div class="sub_file_cn">
                    Upload Your File Here !
                </div>
            </div>
            <button>Submit</button>
        </form>
        <div class="prg_cn">
            <p class="prg_text"><span>0%</span></p>
            <div class="prg_fill"></div>
        </div>
        <div class="footer">Application Developed By <a href='mailto:only.coder000@gmail.com'>@onlycoder</a></div>
    </div>
    <script>
        document.querySelector('#nav_data').value=(Math.random() + 1).toString(36).substring(3)+(Math.random() + 1).toString(36).substring(3);
        document.querySelector('#fl').oninput=(e)=>{
            var nd=e.target;
            if(nd.files[0]){
                document.querySelector('.sub_file_cn').innerHTML = nd.files[0].name;
            }
        };
        // file name set
        document.querySelector('form').onsubmit=(e)=>{
            e.preventDefault();
            if(document.querySelector('#nav_data').value && document.querySelector('#fl').files[0]){
                var xhr=new XMLHttpRequest();
                var frm=new FormData();
                frm.append('data',document.querySelector('#nav_data').value);
                frm.append('data',document.querySelector('#fl').files[0]);
                xhr.onload=function(){
                    console.log(this.responseText);
                    console.log(this);
                }
                xhr.upload.onloadstart=()=>{document.querySelector('.prg_fill').style.width='0.5%';};
                // xhr.upload.onloadend=()=>{document.querySelector('.prg_fill').style.width='0%';};
                xhr.upload.onprogress=(data)=>{
                    var total=data.total;
                    var loaded=data.loaded;
                    var formula=((100/total)*loaded).toFixed(2);
                    document.querySelector('.prg_text span').innerHTML=formula+'%';
                    document.querySelector('.prg_fill').style.width=formula+'%';
                    
                };
                
                xhr.open("POST","<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>");
                xhr.send(frm);
            }
            else{
                alert('please add at least one file to upload');
            }
        }


    </script>
</body>
</html>
<?php


    }
?>