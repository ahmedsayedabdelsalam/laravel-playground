<template>
    <ul class="chat-bar px-1 pt-3">
        <li class="user-item">
            <div class="row no-gutters justify-content-center align-items-center">
                <div class="col-2 mr-2">
                    <img
                    src="https://scontent-hbe1-1.xx.fbcdn.net/v/t1.0-1/p32x32/53379772_2369256173132607_8020592460226887680_n.jpg?_nc_cat=103&amp;_nc_oc=AQk2lqgHWCwwp_v5YcBhgn3L6sIse6Jv3BXRvr-Y_X3OOD3e_MXNw-SpBFsbwRWrl7U&amp;_nc_ht=scontent-hbe1-1.xx&amp;oh=2b6ce7a7f8c97a69501435abeab307ca&amp;oe=5DC32C99"
                    width="32" height="32" alt="" class="rounded-circle">
                </div>
                <div class="col-8">
                    Hashem Fathy
                </div>
                <div class="col-1">
                    <span class="user-active"></span>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {

    }

</script>

<style scoped lang="scss">
    .chat-bar {
        border-left: 1px solid #CCC;
        list-style: none;
        height: 100%;

        .user-item {
            cursor: pointer;

            :hover {
                background-color: #ECECEC
            }

            .user-active {
            background: rgb(66, 183, 42); 
            border-radius: 50%; 
            display: inline-block; 
            height: 6px; 
            margin-left: 4px; 
            width: 6px;
        }
        }
    }
</style>
