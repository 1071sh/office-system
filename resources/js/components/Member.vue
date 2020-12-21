<template>
    <div>
        <div v-for="user in innerUser" :key="user.id">
            <input
                :id="user.id"
                :value="user.id"
                type="checkbox"
                name="checkbox[]"
            />
            <label class="form-check-label" :for="user.id">
                {{ user.name }}</label
            >
        </div>
    </div>
</template>

<script>
import { mapMutations } from "vuex";

export default {
    props: ["users"],
    data() {
        return {
            innerUser: []
        };
    },
    mounted: function() {
        this.innerUser = JSON.parse(this.users);
    },
    methods: {
        getVal: function() {
            var elem = document.getElementById("range");
            var target = document.getElementById("value");
            var rangeValue = function(elem, target) {
                return function(evt) {
                    target.innerHTML = elem.value;
                };
            };
            elem.addEventListener("input", rangeValue(elem, target));
        }
    }
};
</script>
