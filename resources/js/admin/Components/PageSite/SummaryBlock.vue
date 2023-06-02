<template>
  <section class="panel p-3 text-white" :class="[bgClass]">
    <div class="row">
      <div class="col">
        <span class="d-block mb-1 h3">{{ count }}</span>
        <span class="d-block">{{ subject }}</span>
      </div>
      <div class="col">
        <span class="display-4" :class="[iconClass]"></span>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "SummaryBlock",
  props: {
    'url': String,
    'subject': {
      type: String,
      default: '-'
    },
    'bgClass': {
      type: String,
      default: 'bg-main'
    },
    'iconClass': {
      type: String,
      default: 'icon-database'
    }
  },
  data() {
    return {
      count: '-'
    }
  },
  mounted: function () {
    this.updateData();
  },
  methods: {
    updateData: function () {
      if (this.filled(this.url)) {
        axios.get(this.url)
          .then((response) => {
            this.count = response.data.total;
          });
      }
    }
  }
}
</script>
