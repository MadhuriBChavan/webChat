<style scoped>
    .chat-app{
    display:flex;
    width:100%;
    }

    .contactlist{
        padding:5px;
        overflow-x:hidden;
    }

    .conversation{
        width:70%;
        padding:5px;
    }
</style>

<template>
    
    <div class="chat-app">
    <ContactList class="contactlist" :contacts="contacts" @selected="startConversationWith" />
    <Conversation class="conversation" :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactList from './ContactList';

    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data(){
            return{
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },

        mounted() {
            console.log(this.user);
            console.log("hiiiiii");
           axios.get('/contacts')
            .then((response)=>{
                console.log(response.data);
                this.contacts = response.data;
            
    });
        }, 
        methods: {
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);

                axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            hanleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }

                this.updateUnreadCount(message.from_contact, false);
            },
            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }

                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;

                    return single;
                })
            }
        },

      components :{Conversation,ContactList}  

    }
</script>

