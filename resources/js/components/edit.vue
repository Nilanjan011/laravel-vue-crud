<template>
<div>
    <form @submit.prevent="update">
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
     mounted() {
        //  id=this.$route.params.id;
        //  console.log(id);
            axios
            .get(`http://localhost:8000/api/edit/${this.$route.params.id}}`)
            .then(response => {
                 this.name=response.data.name
                this.email=response.data.email
                this.phone=response.data.phone
            }


                // console.log(response.data.name)
            )
            .catch(error => console.log(error))
        },
    methods: {
        handleChange(e) {
        this.image = e.target.files[0];
        },
        update(){
            const fd = new FormData();
            fd.append("name", this.name);
            fd.append("email", this.email);
            fd.append("phone", this.phone);
            fd.append("image", this.image);

            axios
            .post(`http://localhost:8000/api/update/${this.$route.params.id}`, fd)
            .then(response => (
                this.$router.push({name: 'user'})
                // console.log(response.data)
            ))
            .catch(error => {console.log(error)
                if (error.response.status==422) {

                    this.error=error.response.data.errors
                }
            })

        }
    }
}
</script>
