#!/usr/bin/env python3
"""
Genera las imágenes DEMO del theme como SVG propios (sin bancos de
imágenes externos): grano + siluetas editoriales en la paleta de marca.
Se ejecuta una sola vez para regenerar assets/img/demo/*.svg.
Referenciadas desde inc/helpers.php (salasvq_demo_eventos/categorias).
"""
import os

OUT = os.path.join(os.path.dirname(__file__), "demo")
os.makedirs(OUT, exist_ok=True)

PAPER = "#f3efe8"
BLACK = "#171512"
TERRA = "#b8452f"
SAGE = "#9fbfa9"

GRAIN = """
<filter id="grain-{id}">
  <feTurbulence type="fractalNoise" baseFrequency="0.85" numOctaves="2" stitchTiles="stitch" result="noise"/>
  <feColorMatrix in="noise" type="matrix" values="0 0 0 0 0  0 0 0 0 0  0 0 0 0 0  0 0 0 0.06 0"/>
  <feComposite operator="over" in2="SourceGraphic"/>
</filter>
"""

def wrap(id, w, h, bg, accent, body, label):
	return f'''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {w} {h}" width="{w}" height="{h}">
<defs>{GRAIN.format(id=id)}
<linearGradient id="grad-{id}" x1="0" y1="0" x2="1" y2="1">
  <stop offset="0" stop-color="{bg}"/>
  <stop offset="1" stop-color="#0c0a08"/>
</linearGradient>
</defs>
<rect width="{w}" height="{h}" fill="url(#grad-{id})"/>
<g filter="url(#grain-{id})">
  <rect width="{w}" height="{h}" fill="transparent"/>
</g>
{body}
<text x="{w-24}" y="{h-24}" text-anchor="end" font-family="Archivo, sans-serif" font-size="{max(11, w*0.018)}" font-weight="700" letter-spacing="2" fill="{PAPER}" opacity="0.55">{label}</text>
</svg>'''

def mic(cx, cy, s, color, opacity=1):
	return f'''<g transform="translate({cx},{cy}) scale({s})" opacity="{opacity}" fill="none" stroke="{color}" stroke-width="5">
	<rect x="-18" y="-60" width="36" height="70" rx="18"/>
	<path d="M-40,-5 a40,40 0 0 0 80,0"/>
	<line x1="0" y1="35" x2="0" y2="60"/>
	<line x1="-22" y1="60" x2="22" y2="60"/>
</g>'''

def speech(cx, cy, s, color, opacity=1):
	return f'''<g transform="translate({cx},{cy}) scale({s})" opacity="{opacity}" fill="none" stroke="{color}" stroke-width="5">
	<path d="M-55,-40 h110 a15,15 0 0 1 15,15 v45 a15,15 0 0 1 -15,15 h-70 l-25,25 v-25 h-15 a15,15 0 0 1 -15,-15 v-45 a15,15 0 0 1 15,-15 z"/>
	<circle cx="-20" cy="0" r="4" fill="{color}" stroke="none"/>
	<circle cx="5" cy="0" r="4" fill="{color}" stroke="none"/>
	<circle cx="30" cy="0" r="4" fill="{color}" stroke="none"/>
</g>'''

def masks(cx, cy, s, color, opacity=1):
	return f'''<g transform="translate({cx},{cy}) scale({s})" opacity="{opacity}" fill="none" stroke="{color}" stroke-width="5">
	<circle cx="-28" cy="0" r="42"/>
	<path d="M-46,-10 q18,-14 36,0" />
	<path d="M-46,14 q18,14 36,0" />
	<circle cx="28" cy="0" r="42"/>
	<path d="M10,10 q18,14 36,0" />
	<path d="M10,-14 q18,-14 36,0" />
</g>'''

def vinyl(cx, cy, s, color, opacity=1):
	return f'''<g transform="translate({cx},{cy}) scale({s})" opacity="{opacity}" fill="none" stroke="{color}" stroke-width="4">
	<circle r="60"/>
	<circle r="44"/>
	<circle r="30"/>
	<circle r="6" fill="{color}" stroke="none"/>
</g>'''

def crowd(cx, cy, s, color, opacity=1):
	dots = ""
	import random
	random.seed(42)
	for i in range(60):
		x = random.uniform(-140, 140)
		y = random.uniform(-30, 40)
		r = random.uniform(6, 12)
		dots += f'<circle cx="{x:.0f}" cy="{y:.0f}" r="{r:.0f}" fill="{color}" opacity="{opacity*random.uniform(0.5,1):.2f}"/>'
	return f'<g transform="translate({cx},{cy}) scale({s})">{dots}</g>'

def beams(w, h, color, n=5, opacity=0.10):
	out = ""
	for i in range(n):
		x = (i + 0.5) * (w / n)
		out += f'<polygon points="{x-6},0 {x+6},0 {x+70},{h} {x-70},{h}" fill="{color}" opacity="{opacity}"/>'
	return out

def stripes(w, h, color, opacity=0.08):
	out = f'<g opacity="{opacity}">'
	step = 26
	i = -h
	while i < w:
		out += f'<line x1="{i}" y1="{h}" x2="{i+h}" y2="0" stroke="{color}" stroke-width="10"/>'
		i += step
	return out + "</g>"

specs = [
	# filename, w, h, icon-fn, accent, label
	("hero.svg", 1000, 1250, mic, TERRA, "SALA SVQ · SEVILLA EN DIRECTO"),
	("la-sala-1.svg", 900, 1100, crowd, SAGE, "SALA SVQ · PÚBLICO"),
	("la-sala-2.svg", 700, 1000, mic, TERRA, "SALA SVQ · INTERIOR"),
	("evento-1.svg", 640, 800, mic, TERRA, "LOS ESTANQUES"),
	("evento-2.svg", 640, 800, speech, SAGE, "GALDER VARAS"),
	("evento-3.svg", 640, 800, vinyl, TERRA, "CLUB SVQ"),
	("evento-4.svg", 640, 800, masks, SAGE, "IMPRO SEVILLA"),
	("cat-musica.svg", 800, 1000, mic, TERRA, "MÚSICA"),
	("cat-humor.svg", 800, 1000, speech, SAGE, "HUMOR"),
	("cat-escena.svg", 800, 1000, masks, TERRA, "ESCENA"),
	("cat-sesiones.svg", 800, 1000, vinyl, SAGE, "SESIONES"),
	("contacto.svg", 900, 1100, mic, TERRA, "SALA SVQ · FACHADA"),
]

for i, (fname, w, h, iconfn, accent, label) in enumerate(specs):
	body = beams(w, h, accent, n=4, opacity=0.09)
	body += stripes(w, h, PAPER, opacity=0.05)
	if iconfn is crowd:
		body += crowd(w/2, h*0.55, 2.6, accent, 0.85)
	else:
		body += iconfn(w/2, h*0.46, min(w, h) / 220, accent, 0.9)
	svg = wrap(f"art{i}", w, h, BLACK, accent, body, label)
	with open(os.path.join(OUT, fname), "w", encoding="utf-8") as f:
		f.write(svg)

print(f"Generated {len(specs)} SVGs in {OUT}")
