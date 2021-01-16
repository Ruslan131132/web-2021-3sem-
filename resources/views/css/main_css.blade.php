  <style>
	.container {
	  max-width: 960px;
	}
	
	/*
	 * Custom translucent site header
	 */
	
	.navbar {
	  background-color: rgba(0, 0, 0, .85);
	  -webkit-backdrop-filter: saturate(180%) blur(20px);
	  backdrop-filter: saturate(180%) blur(20px);
	}
	#card{
		 background-color: rgb(37 37 37);
	  -webkit-backdrop-filter: saturate(180%) blur(20px);
	  backdrop-filter: saturate(180%) blur(20px);
	
	}
	.navbar a {
	  color: #999;
	  transition: ease-in-out color .15s;
	}
	.navbar a:hover {
	  color: #fff;
	  text-decoration: none;
	}
	
	/*
	.navbar-toggler{
	  color: #999;
	  transition: ease-in-out color .15s;
	
	}
	*/
	
	/*
	
	.navbar-toggler:hover{
		color: #fff;
		text-decoration: none;
	}
	*/
	
	/*
	 * Dummy devices (replace them with your own or something else entirely!)
	 */
	
	.product-device {
	  position: absolute;
	  right: 10%;
	  bottom: -30%;
	  width: 300px;
	  height: 540px;
	  background-color: #333;
	  border-radius: 21px;
	  -webkit-transform: rotate(30deg);
	  transform: rotate(30deg);
	}
	
	.product-device::before {
	  position: absolute;
	  top: 10%;
	  right: 10px;
	  bottom: 10%;
	  left: 10px;
	  content: "";
	  background-color: rgba(255, 255, 255, .1);
	  border-radius: 5px;
	}
	
	.product-device-2 {
	  top: -25%;
	  right: auto;
	  bottom: 0;
	  left: 5%;
	  background-color: #e5e5e5;
	}
	
	
	/*
	 * Extra utilities
	 */
	
	.flex-equal > * {
	  -ms-flex: 1;
	  flex: 1;
	}
	@media (min-width: 768px) {
	  .flex-md-equal > * {
	    -ms-flex: 1;
	    flex: 1;
	  }
	}
	
	.overflow-hidden { overflow: hidden; }
	
	
	
	
	
	
	
	.form-signin {
	  width: 100%;
	  max-width: 330px;
	  padding: 15px;
	  margin: auto;
	}
	.form-signin .checkbox {
	  font-weight: 400;
	}
	.form-signin .form-control {
	  position: relative;
	  box-sizing: border-box;
	  height: auto;
	  padding: 10px;
	  font-size: 16px;
	}
	.form-signin .form-control:focus {
	  z-index: 2;
	}
	.form-signin input[type="number"] {
	  margin-bottom: -1px;
	  border-bottom-right-radius: 0;
	  border-bottom-left-radius: 0;
	  -moz-appearance: textfield;
	  -webkit-inner-spin-button
	}
	.form-signin input[type="number"]::-webkit-inner-spin-button { 
		display: none;
	}
	.form-signin input[type="password"] {
	  margin-bottom: 10px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}
	
	
	
	    
  </style>