<?php

session_start();

require_once('db.php');
/*require_once('about.php');*/


$errors = array();
$imageerrors = 1;

//about add
if(isset($_POST['about-save-btn'])){


	$about_u = $_POST['about_u'];
	$profession = $_POST['profession'];
	$birthday = $_POST['birthday'];
	$age = $_POST['age'];
	$website = $_POST['website'];
	$degree = $_POST['degree'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$city = $_POST['city'];
	/*	echo $about_u;
		echo $profession;
		echo $birthday;
		echo $age;
		echo $website;
		echo $degree;
		echo $phone;
		echo $email;
		echo $city;*/
		/*$query = "SELECT * FROM about";*/


		$insert = "INSERT INTO about (about_you, profession, birthday, age, website, degree, phone, email, city, about_date) VALUES ('$about_u', '$profession', '$birthday', '$age', '$website' ,'$degree', '$phone', '$email', '$city', NOW());";
		$result = mysqli_query($connection,$insert);
		/*var_dump($result);*/

		if(!$result){
			die('failed');
		}
		/*else{

		echo $result;

	}*/


}

// end about add


// about data show regarding date column

/*$query = "SELECT * FROM about";*/
$query = "SELECT * FROM about ORDER BY about_date DESC LIMIT 1";
/*SELECT * FROM TableName WHERE id=(SELECT max(id) FROM TableName)*/
$result = mysqli_query($connection,$query);

if(mysqli_num_rows($result)>0){
	$about = mysqli_fetch_array($result);
	$about_id = $about['about_id'];
	$about_u = $about['about_you'];
	$about_profession = $about['profession'];
	$about_birthday = $about['birthday'];
	$about_age = $about['age'];
	$about_website = $about['website'];
	$about_degree = $about['degree'];
	$about_phone = $about['phone'];
	$about_email = $about['email'];
	$about_city = $about['city'];

}

/*echo $about_id;
echo $about_u;
echo $about_id;*/
// end about data show



// Update query about edit data 

//about add
if(isset($_POST['about-edit-btn'])){


	$about_u = $_POST['about_u'];
	$profession = $_POST['profession'];
	$birthday = $_POST['birthday'];
	$age = $_POST['age'];
	$website = $_POST['website'];
	$degree = $_POST['degree'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$city = $_POST['city'];
	/*	echo $about_u;
		echo $profession;
		echo $birthday;
		echo $age;
		echo $website;
		echo $degree;
		echo $phone;
		echo $email;
		echo $city;*/
		/*$query = "SELECT * FROM about";*/


		$insert = "INSERT INTO about (about_you, profession, birthday, age, website, degree, phone, email, city, about_date) VALUES ('$about_u', '$profession', '$birthday', '$age', '$website' ,'$degree', '$phone', '$email', '$city', NOW());";
		$result = mysqli_query($connection,$insert);
		/*var_dump($result);*/

		if(!$result){
			die('failed');
		}
		/*else{

		echo $result;

	}*/


}






// Fatcs Insert query, facts add page

if(isset($_POST['facts-add-btn'])){


	$facts_description = $_POST['facts_description'];
	$facts_clients = $_POST['facts_clients'];
	$facts_projects = $_POST['facts_projects'];
	$facts_support = $_POST['facts_support'];
	$facts_workers = $_POST['facts_workers'];

	/*echo $facts_description;*/
/*		echo $profession;
		echo $birthday;
		echo $age;
		echo $website;

		echo $city;*/
		/*$query = "SELECT * FROM about";*/


		$insertFacts = "INSERT INTO facts (facts_description, facts_clients, fatcs_projects, facts_support, facts_workers, facts_date)
		VALUES ('$facts_description', '$facts_clients', '$facts_projects', '$facts_support', '$facts_workers', NOW() );";
		$resultFacts = mysqli_query($connection,$insertFacts);
		/*var_dump($result);*/

		if(!$resultFacts){
			die('failed');
		}
		/*else{

		echo $result;

	}*/


}
// end facts add



// about data show regarding date column

/*$query = "SELECT * FROM about";*/
$ShowqueryFacts = "SELECT * FROM facts ORDER BY facts_date DESC LIMIT 1";
/*SELECT * FROM TableName WHERE id=(SELECT max(id) FROM TableName)*/
$ShowresultFacts = mysqli_query($connection,$ShowqueryFacts);

if(mysqli_num_rows($ShowresultFacts)>0){
	$facts = mysqli_fetch_array($ShowresultFacts);

	$facts_description = $facts['facts_description'];
	$facts_clients = $facts['facts_clients'];
	$facts_projects = $facts['facts_projects'];
	$facts_support = $facts['facts_support'];
	$facts_workers = $facts['facts_workers'];

	/*echo $facts_description;*/


}



// Fatcs update query, facts edit page

if(isset($_POST['facts-edit-btn'])){

	/*$facts_id =*/ 


	$facts_description = $_POST['facts_description'];
	$facts_clients = $_POST['facts_clients'];
	$facts_projects = $_POST['facts_projects'];
	$facts_support = $_POST['facts_support'];
	$facts_workers = $_POST['facts_workers'];

	/*echo $facts_description;*/

	
	$insertFacts = "UPDATE facts SET facts_description ='$facts_description', facts_clients='$facts_clients', facts_projects='$facts_projects', facts_support='$facts_support', facts_workers='$facts_workers'  ";
	$resultFacts = mysqli_query($connection,$insertFacts);
	/*var_dump($result);*/

	if(!$resultFacts){
		die('failed');
	}
		/*else{

		echo $result;

	}*/


}
// end facts edit



//image upload


/*if($SERVER["REQUEST_METHOD"] =="POST"){*/

	if(isset($_POST['blog-add-btn'])){
		$post_title = $_POST['post_title'];
		$post_content = $_POST['post_content'];
		$blog_blockquote = $_POST['blog_blockquote'];
		$source_title = $_POST['source_title'];
		$blog_del = 1;

		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['upload_image']['name'];
		$file_size = $_FILES['upload_image']['size'];
		$file_temp = $_FILES['upload_image']['tmp_name'];

		$div = explode('.', $file_name);
		/*print_r($div);*/
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 1, 10).'.'.$file_ext;

		/*$uploaded_image = "uploads/.$unique_image";*/
		$uploaded_image = "../admin/uploads/".$unique_image;

		/*if(empty($file_name)){
			$imageerrors = 2;		
			$errors['upload_image'] = 'error';
		}*/
		if (empty($file_name)) {
			$imageerrors = 2;
    
			$errors['upload_image'] = 'Please Select any Image!';
		}
		elseif ($file_size >1048567) {
  
			$errors['upload_image'] = 'Image Size should be less then 1MB!';
		}
		elseif (in_array($file_ext, $permited) == false) {
			echo "<span class='error'> You can upload only: ".implode(',', $permited)."  </span>";
		}
		else{

			move_uploaded_file($file_temp, $uploaded_image);

			$insertBlogs = "INSERT INTO blog (blog_title, blog_image, blog_content, blog_blockquote_footer, blog_source_title, blog_del, blog_date)
			VALUES ('$post_title', '$uploaded_image', '$post_content', '$blog_blockquote', '$source_title', '$blog_del', NOW() );";
			$resultBlogs = mysqli_query($connection,$insertBlogs);
			/*var_dump($result);*/

			if(!$resultBlogs){
				die('failed');
			}
			else{
				echo "<span class='success'> Inserted successfully .</span>";
				header('Location:add_blog.php');
			}


		}


	}


	// show blog content in front page(test)

	$ShowqueryBlog = "SELECT * FROM blog WHERE blog_del=1 ORDER BY blog_date DESC LIMIT 1";
	/*SELECT * FROM TableName WHERE id=(SELECT max(id) FROM TableName)*/
	$ShowresultBlog = mysqli_query($connection,$ShowqueryBlog);

	if(mysqli_num_rows($ShowresultBlog)>0){
		$blog = mysqli_fetch_array($ShowresultBlog);

		$blog_title = $blog['blog_title'];
		$blog_image = $blog['blog_image'];
		$blog_content = $blog['blog_content'];
		$blog_blockquote_footer = $blog['blog_blockquote_footer'];
		$blog_source_title = $blog['blog_source_title'];
		$blog_date = $blog['blog_date'];

		/*echo $blog_date;*/


	}


// show blog data in the table
	$ShowqueryBlogTable = "SELECT * FROM blog";
	/*SELECT * FROM TableName WHERE id=(SELECT max(id) FROM TableName)*/
	$resultBlog = mysqli_query($connection,$ShowqueryBlogTable);

	/*echo $blog_date;*/
// show blog data in the table end


// show blog table data in edit blog table page after click edit button

	$ShowqueryBlogEdit = "SELECT * FROM facts ORDER BY facts_date DESC LIMIT 1";
	/*SELECT * FROM TableName WHERE id=(SELECT max(id) FROM TableName)*/
	$ShowresultBlogEdit = mysqli_query($connection,$ShowqueryFacts);

	if(mysqli_num_rows($ShowresultBlogEdit)>0){
		$facts = mysqli_fetch_array($ShowresultBlogEdit);

		$facts_description = $facts['facts_description'];
		$facts_clients = $facts['facts_clients'];
		$facts_projects = $facts['facts_projects'];
		$facts_support = $facts['facts_support'];
		$facts_workers = $facts['facts_workers'];

		/*echo $facts_description;*/


	}






//admin login

	$errors 	= array();
	$username 	="" ;

// if user clicks on the login button
	if(isset($_POST['login-btn'])){
		$username 			= $_POST['username'];
		$password			= $_POST['password'];

		echo $username;
		echo $password;

	//validation

		if(empty($username))
		{
			$errors['username'] = "Username Required";

		}

		if(empty($password)) {
			$errors['password'] = "Password Required";

		}

		$sql = "SELECT * FROM admin WHERE id=1 AND password='123' ";

		$result = mysqli_query($connection,$sql);
		$login = mysqli_fetch_array($result);
		echo $login['password'];
		echo $login['id'];

		if(count($login)>0){
			$_SESSION['id'] 		 = $user['id'];
			$_SESSION['username']	 = $user['username'];

			
			header('location:../test.php');
			exit(0);
		}

		else{
			$errors['login_fail'] = "Wrong credentials";
		}


	}



//logout 

	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['id']);
		unset($_SESSION['username']);

		header('location:login.php');
		exit();
	}



// social media insert


	//about add
	if(isset($_POST['social-save-btn'])){


		$twitter = $_POST['twitter'];
		$facebook = $_POST['facebook'];
		$instragram = $_POST['instragram'];
		$skype = $_POST['skype'];
		$linkdin = $_POST['linkdin'];


		$insert = "INSERT INTO about (twitter, facebook, instragram, skype, linkdin) VALUES ('$twitter', '$facebook', '$instragram', '$skype', '$linkdin');";
		$result = mysqli_query($connection,$insert);
		/*var_dump($result);*/

		if(!$result){
			die('failed');
		}
		/*else{

		echo $result;

	}*/


}

// end about add


?>