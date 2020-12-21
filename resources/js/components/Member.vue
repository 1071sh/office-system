<template>
    <div>
        <div v-for="user in innerUser" :key="user.id">
            <input
                :id="user.id"
                :value="user.id"
                type="checkbox"
                name="checkbox[]"
                :checked="user.id == user.id"
            />
            <label class="form-check-label" :for="user.id">
                {{ user.name }}</label
            >
            <input
                type="range"
                :id="user.id"
                min="0"
                max="10"
                step="1"
                value="5"
                @chenge="getVal"
            />
            <span id="value">50</span>
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
