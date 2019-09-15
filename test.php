<script>

    function Person(name){
        this.name = name;
        this.greeting = function(){
            alert("Hello World! "+name);
        }
        
        this.name.message = name+" How are you?";
        
//        return obj;
    }
    
    const sujan = new Person('Sujan');
    
    console.log(sujan.name.message);
    
//    sujan.greeting();
    
</script>