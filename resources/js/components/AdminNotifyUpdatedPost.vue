<template>
    <div>
        <b-modal id="modal-1" centered :title="modalTitle" ok-only>
            <h5>Были изменены следующие поля:</h5>
            <ul>
                <li v-for="(item, key) in modalChanges">
                    <strong> {{ key }} :</strong> {{ item }}
                </li>
            </ul>
            <a :href="modalLink">Открыть статью</a>
        </b-modal>
    </div>

</template>

<script>
export default {
name: "AdminNotifyUpdatedPost",
    data() {
        return {
            modalTitle: '',
            modalLink: '',
            modalChanges: {}
        }
    },
    mounted() {
        Echo
            .private('admin-notify')
            .listen('.App\\Events\\AdminNotifyUpdatePost', (data) => {
                this.modalTitle = data.post.title;
                this.modalLink = data.post.link;
                this.modalChanges = data.post.changes;
                this.$bvModal.show('modal-1');
            });
    }
}
</script>

<style scoped>

</style>
