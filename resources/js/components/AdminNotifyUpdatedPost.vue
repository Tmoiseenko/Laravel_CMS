<template>
    <b-modal id="modal-1" centered :title="modalTitle">
        <p class="my-4">Hello from modal!</p>
    </b-modal>
</template>

<script>
export default {
name: "AdminNotifyUpdatedPost",
    data() {
        return {
            postHasUpdated: false,
            modalTitle: ''
        }
    },
    mounted() {
        Echo
            .private('admin-notify')
            .listen('.App\\Events\\AdminNotifyUpdatePost', (data) => {
                console.log(data.post);
                this.modalTitle = data.post.title;
                this.$bvModal.show('modal-1');
            });
    }
}
</script>

<style scoped>

</style>
