<template>
  <section class="panel h-100-c">
    <header class="panel-heading">
      <h2 class="h5 float-left">{{ array_get(trans, 'module.source_from') }}</h2>
    </header>
    <div class="panel-body">
      <div id="visited-source-pie"></div>

      <template v-for="(row, index) in lineSource">
        <div class="row pl-3 pr-1" :class="{'pb-2': parseInt(index) === (lineSource.length - 1)}">
          <div class="col-sm-8 col-xs-12">
            <span class="badge float-left clabels d-inline mt-1 mr-3 no-radius" :class="getBadgeClass(index)"></span>
            <div class="clabels-text d-inline txt-dark text-capitalize float-left">
              <span class="d-block font-weight-bold mb-1">{{ row.rate }}%  {{ row.source }}</span><!--
              --><span class="d-block text-muted small">{{ row.count }} {{ array_get(trans, 'module.visits') }}</span>
            </div>
          </div>
          <div class="col-sm-4 col-xs-12">
            <div class="float-right mb-1 visited-source-item" :id="'visited-source-item-' + index"></div>
          </div>
        </div>
        <hr class="my-2 w-100" v-if="parseInt(index) < (lineSource.length - 1)" />
      </template>
    </div>
  </section>
</template>

<script>
import 'amcharts3';
import 'amcharts3/amcharts/serial';
import 'amcharts3/amcharts/pie';
import 'amcharts3/amcharts/themes/light';

export default {
  name: "VisitedSource",
  props: {
    'urls': Object,
    'trans': Object,
    'days': {
      type: Number,
      default: 30
    }
  },
  data() {
    return {
      pieChart: null,
      pieSource: [],
      lineCharts: [],
      lineSource: [],
    }
  },
  mounted: function () {
    this.createAmPie();
    this.updateLineSource();
  },
  watch: {
    pieSource: function (afterVal, beforeVal) {
      if (JSON.stringify(afterVal) !== JSON.stringify(beforeVal)) {
        this.pieChart.dataProvider = afterVal;
        this.$nextTick(() => {
          this.pieChart.validateData();
          this.pieChart.animateAgain();
        });
      }
    },
    lineSource: function (afterVal, beforeVal) {
      if (JSON.stringify(afterVal) !== JSON.stringify(beforeVal)) {
        for (let i in this.lineCharts) {
          if (this.lineCharts.hasOwnProperty(i)) {
            this.lineCharts[i].clear();
          }
        }
        this.lineCharts = [];
        this.$nextTick(() => {
          for (let index in afterVal) {
            this.createAmLine(index);
          }
        });
      }
    }
  },
  methods: {
    createAmPie: function () {
      this.pieChart = AmCharts.makeChart('visited-source-pie', {
        "hideCredits":true,
        "type": "pie",
        "theme": "light",
        "dataProvider": this.pieSource,
        "titleField": "source",
        "valueField": "count",
        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
        "innerRadius": "0",
        "labelRadius": 5,
        "radius": "45%",
        "labelText": "",
      });
      this.updatePieSource();
    },
    updatePieSource: function () {
      if (this.filled(this.urls.visited_source)) {
        axios.get(this.urls.visited_source + '?days=' + this.days)
          .then((response) => {
            this.pieSource = response.data;
          });
      }
    },
    updateLineSource: function () {
      if (this.filled(this.urls.visited_source_list)) {
        axios.get(this.urls.visited_source_list + '?days=' + this.days)
          .then((response) => {
            this.lineSource = response.data;
          });
      }
    },
    createAmLine: function (index) {
      this.lineCharts.push(AmCharts.makeChart('visited-source-item-' + index, {
        "hideCredits":true,
        "type": "serial",
        "theme": "light",
        "dataProvider": this.lineSource[index].week,
        "valueAxes": [
          {"id": "v1", "axisAlpha": 0, "gridAlpha": 0, "zeroGridAlpha": 0}
        ],
        "categoryAxis": {"dashLength": 0, "gridAlpha": 0, "axisAlpha": 0},
        "balloon": {"shadowAlpha": 0},
        "marginTop": 0,
        "marginRight": 0,
        "marginLeft": 0,
        "marginBottom": 0,
        "autoMargins": false,
        "startDuration": 1,
        "graphs": [{
          "id": "g1",
          "balloon": {"drop": false, "adjustBorderColor": false, "color": "#ffffff"},
          "fillAlphas": 0.2,
          "bullet": "round",
          "bulletBorderAlpha": 1,
          "bulletColor": "#FFFFFF",
          "hideBulletsCount": 5,
          "lineThickness": 1,
          "valueField": "value"
        }],
        "chartCursor": {
          "valueLineEnabled": false,
          "categoryBalloonEnabled": false,
          "cursorColor": "#67b7dc",
          "pan": true
        },
        "categoryField": "date",
        "export": {"enabled": false},
      }));
    },
    getBadgeClass: function (index) {
      switch (parseInt(index)) {
        case 0:
          return ['badge-info'];
        case 1:
          return ['badge-warning'];
        case 2:
          return ['badge-success'];
        default:
          return [];
      }
    }
  }
}
</script>

<style scoped>
#visited-source-pie {
  width: 100%;
  height: 195px;
}
.visited-source-item {
  width: 100%;
  height: 30px;
}
</style>
