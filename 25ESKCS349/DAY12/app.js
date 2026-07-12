let tasks =
JSON.parse(localStorage.getItem("tasks")) || [];



// LOGIN

function login(){

let email=document.getElementById("email").value;

let password=document.getElementById("password").value;


if(email && password){

localStorage.setItem(
"login",
"true"
);


location="dashboard.html";

}

else{

alert("Enter details");

}

}



// ADD PRODUCT

function addTask(){


let title=document.getElementById("title").value;


let file=document.getElementById("image").files[0];


let image="";


if(file)
{

image=URL.createObjectURL(file);

}



tasks.push({

id:Date.now(),

title:title,

image:image

});


localStorage.setItem(
"tasks",
JSON.stringify(tasks)
);


showTasks();


}



// READ + SEARCH

function showTasks(){


let search=document.getElementById("search")?.value
.toLowerCase() || "";


let output="";


tasks
.filter(t=>t.title.toLowerCase()
.includes(search))
.forEach(t=>{


output+=`

<div class="col-md-4">

<div class="card shadow p-3 mt-3">


<img src="${t.image}"
height="150">


<h4>
${t.title}
</h4>


<button class="btn btn-danger"
onclick="deleteTask(${t.id})">

Delete

</button>


</div>

</div>

`;


});


document.getElementById("list").innerHTML=output;


}




// DELETE

function deleteTask(id){


tasks=
tasks.filter(t=>t.id!=id);


localStorage.setItem(
"tasks",
JSON.stringify(tasks)
);


showTasks();

}



// LOGOUT

function logout(){

localStorage.removeItem("login");

location="index.html";

}


showTasks();
