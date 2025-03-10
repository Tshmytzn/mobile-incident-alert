<style>
/* Full-screen overlay */
.overlay-mia {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8); /* Transparent black */
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 9999; /* Ensures it appears on top */
}

/* Heartbeat Loader */
.heartbeatloader {
  position: relative;
  width: 30vmin;
  height: 30vmin;
}

/* Heartbeat Animation */
.svgdraw {
  position: absolute;
  top: 30%;
  left: 26%;
  width: 50%;
  height: 50%;
  color: #fff;
  transform: scale(1.4);
  z-index: 3;
}

.path {
  stroke: rgba(255, 255, 255, 0.95);
  stroke-width: 4;
  stroke-dasharray: 1000px;
  stroke-dashoffset: 1000px;
  animation: draw 1.5s infinite forwards normal linear;
}

@keyframes draw {
  to {
    stroke-dashoffset: 0;
  }
}

.innercircle {
  position: absolute;
  top: 17%;
  left: 100.5%;
  transform: translate(-50%, -50%) scale(1.2);
  width: 160%;
  height: auto;
  z-index: 1;
  opacity: 0.97;
  animation: innerbeat 1.5s infinite linear forwards;
}

.innercircle:before,
.innercircle:after {
  position: absolute;
  content: "";
  left: 25%;
  top: 0;
  width: 25%;
  height: auto;
  padding-bottom: 40%;
  background: rgb(225, 95, 95);
  border-radius: 50px 50px 0 0;
  transform: rotate(-45deg);
  transform-origin: 0 100%;
}

.innercircle:after {
  left: 0;
  transform: rotate(45deg);
  transform-origin: 100% 100%;
}

@keyframes innerbeat {
  0%, 10% {
    transform: translate(-50%, -50%) scale(1.2);
  }
  50% {
    transform: translate(-50%, -50%) scale(1.3);
  }
  60% {
    transform: translate(-50%, -50%) scale(1.25);
  }
  75% {
    transform: translate(-50%, -50%) scale(1.3);
  }
}

.outercircle {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-color: rgba(238, 92, 92, 0.9);
  box-shadow: 0 0 30px 0px #fff;
  position: absolute;
  z-index: -1;
  opacity: 0.7;
  animation: outerbeat 1.5s infinite linear forwards;
}

@keyframes outerbeat {
  0%, 10% {
    transform: scale(1.2);
  }
  50% {
    transform: scale(1.3);
  }
  60% {
    transform: scale(1.25);
  }
  75% {
    transform: scale(1.3);
  }
}
</style>

<!-- Overlay with Heartbeat Loader -->
<div class="overlay-mia" id="overlay-mia">
  <div class="heartbeatloader">
      <svg class="svgdraw" width="100%" height="100%" viewBox="0 0 150 400" xmlns="http://www.w3.org/2000/svg">
          <path class="path"
              d="M 0 200 l 40 0 l 5 -40 l 5 40 l 10 0 l 5 15 l 10 -140 l 10 220 l 5 -95 l 10 0 l 5 20 l 5 -20 l 30 0"
              fill="transparent" stroke-width="4" stroke="black"></path>
      </svg>
      <div class="innercircle"></div>
      <div class="outercircle"></div>
  </div>
</div>
