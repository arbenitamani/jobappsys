<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="./choose.css">
</head>
<body>
    <div class="choose-wrapper">
        <div class="choosebox">
            <h1 class="join">Join us as an Employer or as a Job Seeker </h1>

            <div class="boxes">
                <div class="box" id="employerBox">
                <svg fill="#000000" width="200px" height="200px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">

<title/>

<g data-name="Layer 42" id="Layer_42">

<path d="M48,33H16C8.83,33,3,38.45,3,45.14V61H61V45.14C61,38.45,55.17,33,48,33ZM35.91,35l-.54,6H28.63l-.54-6ZM36,51.44l-4,3.27-4-3.27L28.64,43h6.72ZM5,59V45.14C5,39.55,9.93,35,16,35H26.09l.62,7L26,52.33l6,5,6-5L37.29,42l.62-7H48c6.07,0,11,4.55,11,10.14V59Z"/>

<path d="M32,31A14,14,0,1,0,18,17,14,14,0,0,0,32,31Zm-7.31-4.5a11.94,11.94,0,0,1,14.62,0,11.94,11.94,0,0,1-14.62,0ZM32,5a12,12,0,0,1,8.8,20.13,13.94,13.94,0,0,0-17.6,0A12,12,0,0,1,32,5Z"/>

</g>

</svg>
                    <h1>I'm an Employer</h1>
                </div>
                <div class="box" id="userBox">
                <svg fill="#000000" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 480.001 480.001" xml:space="preserve">
<g>
	<g>
		<g>
			<path d="M465.136,463.538l-77.738-91.806c34.369-34.938,55.862-80.121,61.21-129.619c6.277-58.107-10.447-115.134-47.093-160.574
				C359.759,29.72,297.637,0,231.078,0c-49.637,0-98.306,17.196-137.037,48.417C48.563,85.03,20.062,137.172,13.788,195.239
				C7.514,253.316,24.231,310.353,60.86,355.84c41.691,51.792,103.798,81.497,170.395,81.497c49.663,0,98.365-17.183,137.139-48.387
				c1.464-1.179,2.909-2.376,4.338-3.587l77.14,91.1c1.978,2.336,4.798,3.538,7.637,3.538c2.283,0,4.578-0.778,6.457-2.369
				C468.181,474.063,468.704,467.752,465.136,463.538z M355.851,373.372c-35.229,28.351-79.478,43.964-124.596,43.964
				c-60.512,0-116.94-26.985-154.817-74.039c-33.278-41.327-48.466-93.145-42.765-145.91c5.7-52.755,31.593-100.128,72.915-133.395
				C141.781,35.623,185.992,20,231.078,20C291.555,20,348,47.004,385.944,94.091c33.289,41.279,48.481,93.085,42.778,145.874
				C423.022,292.732,397.141,340.111,355.851,373.372z"/>
			<path d="M311.928,255.675c-11.358-10.369-24.607-18.484-38.745-23.963c26.484-15.338,44.34-43.997,44.34-76.749
				c0-48.837-39.739-88.57-88.586-88.57c-48.856,0-88.603,39.732-88.603,88.57c0,33.308,18.472,62.378,45.705,77.515
				c-13.413,5.457-25.976,13.296-36.815,23.19c-23.351,21.315-36.21,49.2-36.21,78.519v34.132c0,5.523,4.477,10,10,10h215.123
				c5.522,0,10-4.477,10-10v-34.132C348.135,304.874,335.276,276.991,311.928,255.675z M160.469,159.091
				c-0.081-1.367-0.135-2.742-0.135-4.129c-0.001-37.81,30.774-68.57,68.602-68.57c36.822,0,66.948,29.163,68.511,65.598
				l-95.703-34.751c-4.078-1.482-8.649-0.162-11.311,3.266L160.469,159.091z M218.074,358.319h-85.062v-24.133
				c0-39.54,30.596-75.095,70.23-86.662c1.758,1.538,4.054,2.477,6.574,2.477h8.258V358.319z M166.669,183.715l35.093-45.192
				l93.488,33.947c-7.756,29.381-34.543,51.109-66.315,51.109C201.37,223.58,177.565,207.225,166.669,183.715z M328.135,358.318
				h-90.061V250h9.484c2.936,0,5.569-1.273,7.398-3.29c41.056,10.628,73.179,46.96,73.179,87.475V358.318z"/>
		</g>
	</g>
</g>
</svg>
                    <h1>I'm a Job Sekeer</h1>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("employerBox").addEventListener("click", function() {
            window.location.href = "employer_register.php"; 
        });

        document.getElementById("userBox").addEventListener("click", function() {
            window.location.href = "job_sekeer_register.php"; 
        });
    </script>
</body>
</html>
