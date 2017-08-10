<template>
    <button
            class="btn btn-default"
            v-bind:class="{'btn-success' : followed}"
            v-text="text"
            v-on:click="follow"
    ></button>
</template>

<script>
    export default {
        props:['user'],
        mounted() {
            var self = this;
            axios.get('/api/user/followers',{'user':this.user}).then(response => {
                self.followed = response.data.followed;
            })
        },
        data(){
            return {
                followed: false,
            }
        },
        methods:{
            follow(){
                var self = this;
                axios.post('/api/user/follow',{'user':this.user}).then(response => {
                    self.followed = response.data.followed;
                })
            }
        },
        computed: {
            text(){
                return this.followed ? '已关注' : '关注他';
            }
        }
    }
</script>