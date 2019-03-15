<<style lang="scss">
    h1{
            font-size: 20px;
    padding: 10px;
    margin: 0;
    border-bottom: 1px dashed lightgrey;
    }

</style>>
<template>
    <div class="conversation">
        <h1>{{ contact ? contact.name : 'Select a Contact' }}    <a href="#" class="fa fa-facebook"></a></h1>
        <MessagesFeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>
<script>
    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';

 export default {
            props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods: {
            sendMessage(text) {
                // console.log(text);
                if (!this.contact) {
                    return;
                }

                axios.post('/conversation/send', {
                     contact_id: this.contact.id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);

                axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })

                })
            }
        },
        components: {MessagesFeed, MessageComposer}

 }
</script>

