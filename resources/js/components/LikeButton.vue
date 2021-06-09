<template>
    <div>
        <span class="like-btn" @click="likeReceta" :class="{ 'like-active' : isActive }"></span>

        <p>{{ cantidadLikes }} Les gustó esta receta</p>
    </div>
</template>



<script>
export default {
    props: ['recetaId', 'like', 'likes'],
    data: function() {
        return {
            isActive: this.like,
            totalLikes: this.likes
        }
    },
    mounted() {
        console.log(this.like)
    },
    methods: {
        likeReceta() {
            axios.post('/recetas/' + this.recetaId )
                    .then( resp => {
                        if ( resp.data.attached.length > 0 ) {
                            this.$data.totalLikes++;
                        } else {
                            this.$data.totalLikes--;
                        }

                        this.isActive = !this.isActive;
                    })
                    .catch( error => {
                        if ( error.response.status ) {
                            window.location = '/register';
                        }
                    } );
        }
    },
    computed: {
        cantidadLikes: function() {
            return this.totalLikes;
        }
    },
}
</script>
