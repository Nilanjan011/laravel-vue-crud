<template>
<div>
    <form @submit.prevent="add">
    <div class="form-group">
        <label>name</label>
        <input type="text" class="form-control" v-model="name">
        <div class="alert alert-danger" v-if="error && error.name">{{error.name[0]}}</div>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" v-model="email">
        <div class="alert alert-danger" v-if="error && error.email">{{error.email[0]}}</div>
    </div>
     <div class="form-group">
        <label>phone</label>
        <input type="text" class="form-control" v-model="phone">
        <div class="alert alert-danger" v-if="error && error.phone">{{error.phone[0]}}</div>
    </div>
     <div class="form-group">
        <label>image</label>
        <input @change="handleChange" type="file" class="form-control" />
        <div class="alert alert-danger" v-if="error && error.image">{{error.image[0]}}</div>
    </div>
    <button type="submit" class="btn btn-primary">Add Post</button>
</form>

</div>   
</template>

<script>
    export default {
         data() {
            return {
                image: "",
                name: "",
                email: "",
                phone: "",
                error:[]
            };
        },
   
    methods: {
        handleChange(e) {
        this.image = e.target.files[0];
        },
        
        add(){
            const fd = new FormData();
            fd.append("name", this.name);
            fd.append("email", this.email);
            fd.append("phone", this.phone);
            fd.append("image", this.image);

            axios
            .post('http://localhost:8000/api/add', fd)
            .then(response => (
                this.$router.push({name: 'user'})
                // console.log(response.data)
            ))
            .catch(error =>{
                // console.log(error.response.data.errors.name[0]);
                if (error.response.status==422) {

                    this.error=error.response.data.errors
                }
          
            })

        }
    }
}
</script>
