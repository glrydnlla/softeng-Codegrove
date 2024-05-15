@extends('template')

@section('title', 'Login')

@section('content')
    <div class="container-fluid bg-dark" style="height: 100vh; position: relative; overflow: hidden;">
        @if(isset($errors) && $errors->isEmpty() == false)
            <div class="alert alert-danger alert-dismissible fade show ms-5 me-5 mt-3 mb-3" role="alert">
                <strong>{{ $errors->first() }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row justify-content-center align-items-center" style="height: 100%;">
            <div class="col-md-6 col-lg-4" style="position: relative; z-index: 999;">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="text-center mb-3">Log in to Codegrove</h4>
                        <form action="login" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="creds-input" class="form-label fs-6">Email or Username</label>
                                <input type="text" class="form-control form-control-sm" id="creds-input" name="creds" value="{{ old('creds') }}">
                            </div>
                            <div class="mb-3">
                                <label for="password-input" class="form-label fs-6">Password</label>
                                <input type="password" class="form-control form-control-sm" id="password-input" name="password" value="{{ old('password') }}">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-block">Login</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <small>Don't have an account? <a href="/register">Register</a></small>
                        </div>
                    </div>
                </div>
            </div>
            <canvas id="particle-canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></canvas>
        </div>
    </div>

    <script>
        // Vector class
        class Vector {
            constructor(x, y) {
                this.x = x
                this.y = y
            }

            setValue(x, y) {
                this.x = x
                this.y = y
            }
        }

        // ParticleCanvas class
        class ParticleCanvas {
            constructor(canvas, mousePosition) {
                this.canvas = canvas
                this.ctx = canvas.getContext("2d")
                this.mousePosition = mousePosition
                this.particles = []
                this.numParticles = 100
            }

            init() {
                for (let i = 0; i < this.numParticles; i++) {
                    this.particles.push(new Particle(this.canvas.width, this.canvas.height))
                }
            }

            draw() {
                this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height)
                for (let i = 0; i < this.numParticles; i++) {
                    let particle = this.particles[i]
                    this.ctx.beginPath()
                    this.ctx.arc(particle.position.x, particle.position.y, particle.radius, 0, Math.PI * 2)
                    this.ctx.fillStyle = particle.color
                    this.ctx.fill()

                    // Interactivity with mouse
                    let distance = Math.sqrt(Math.pow(particle.position.x - this.mousePosition.x, 2) + Math.pow(particle.position.y - this.mousePosition.y, 2))
                    if (distance < 50) {
                        let acceleration = new Vector(this.mousePosition.x - particle.position.x, this.mousePosition.y - particle.position.y)
                        acceleration.setValue(acceleration.x * 0.02, acceleration.y * 0.02)
                        particle.velocity.x += acceleration.x
                        particle.velocity.y += acceleration.y
                    }

                    particle.update()
                }
                requestAnimationFrame(() => this.draw())
            }
        }

        // Particle class
        class Particle {
            constructor(canvasWidth, canvasHeight) {
                this.canvasWidth = canvasWidth
                this.canvasHeight = canvasHeight
                this.position = new Vector(Math.random() * canvasWidth, Math.random() * canvasHeight)
                this.velocity = new Vector(Math.random() - 0.5, Math.random() - 0.5)
                this.radius = Math.random() * 3 + 1
                this.color = `rgba(255, 255, 255, ${Math.random()*0.5})`
            }

            update() {
                this.position.x += this.velocity.x
                this.position.y += this.velocity.y

                if (this.position.x > this.canvasWidth + this.radius) {
                    this.position.x = -this.radius
                }
                if (this.position.x < -this.radius) {
                    this.position.x = this.canvasWidth + this.radius
                }
                if (this.position.y > this.canvasHeight + this.radius) {
                    this.position.y = -this.radius
                }
                if (this.position.y < -this.radius) {
                    this.position.y = this.canvasHeight + this.radius
                }
            }
        }

        // Initialization
        (function () {
            let canvas = document.getElementById("particle-canvas")
            canvas.width = window.innerWidth
            canvas.height = window.innerHeight

            let mousePosition = new Vector(0, 0)
            window.addEventListener("mousemove", function (e) {
                mousePosition.setValue(e.clientX, e.clientY)
            })

            let particleCanvas = new ParticleCanvas(canvas, mousePosition)
            particleCanvas.init()
            particleCanvas.draw()
        })();
    </script>
@endsection
