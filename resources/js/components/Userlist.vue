<template>
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
             
                <th>Name</th>
                <th>Email</th>
                <th>phone</th>
                <th>image</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id">
                
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.phone }}</td>
                <td><img :src="'storage/ava/'+ user.profile_img" alt="image" width="50px" height="50px">
                    </td>
            
                <td>
                    <div class="btn-group" >
                        <router-link :to="{name: 'edit', params: { id: user.id }}" class="btn btn-primary">Edit
                        </router-link>
                    </div>
                </td>
                <td><button class="btn btn-danger" @click="deletePost(user.id)">Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
         data() {
            return {
            users:[]
            }
         },
        mounted() {
            axios
            .get('http://localhost:8000/api/get')
            .then(response => (
                this.users=response.data
                // console.log(response.data)
            ))
            .catch(error => console.log(error))
        },
        methods:{
            deletePost(id)
            {
                 axios
            .delete(`http://localhost:8000/api/del/${id}`)
            .then(response => {
                  // this.$router.push({name: 'user'})
                // console.log(response.data)
                 let i = this.users.map(item => item.id).indexOf(id);
                        this.users.splice(i, 1)
            }
              
            )
            .catch(error => console.log(error))
             
            
            }
        }
    }
</script>
