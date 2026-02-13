# DataFusion AI Light Theme Design System

This document outlines the core design tokens and components used in the DataFusion AI "Premium Light" theme. Use these guidelines to maintain visual consistency across all new views and components.

## Core Color Palette

| Name | Tailwind Class | HEX/Usage |
|------|----------------|-----------|
| **Primary Background** | `bg-slate-50/50` | Main application backdrop |
| **Card Background** | `bg-white` | Surfaces for content and data |
| **Primary Text** | `text-slate-900` | Headings and high-emphasis body |
| **Secondary Text** | `text-slate-500` | Captions and secondary labels |
| **Brand Accent** | `indigo-600` | Primary buttons and active states |
| **Success** | `emerald-500` | Status indicators and positive trends |
| **Warning** | `amber-500` | Environment data and caution notices |
| **Danger** | `red-600` | Deletion actions and errors |

## Visual Utilities

### 1. Glassmorphism (Light)
Used for the sidebar and navigational elements.
```html
<div class="glass border border-slate-200 shadow-sm">
  <!-- Content -->
</div>
```

### 2. Premium Gradients
Use subtle, low-opacity background gradients for depth.
```html
<!-- Blue Glow -->
<div class="absolute bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>

<!-- Text Gradients -->
<span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">
  Premium Text
</span>
```

### 3. Surface Elevations
| Element | Shadow Class |
|---------|--------------|
| **Standard Card** | `shadow-sm hover:shadow-md transition-shadow` |
| **Floating Modal** | `shadow-2xl shadow-indigo-500/10` |
| **Primary Button** | `shadow-lg shadow-indigo-600/20` |

### 4. Interactive Elements
- **Inputs**: Use `bg-slate-50 border-slate-200 focus:bg-white focus:ring-4 focus:ring-indigo-500/10`.
- **Buttons**: Rounded `2xl` or `xl` with `font-bold` and subtle `active:scale-95` feedback.

## Component Recipes

### Header Component
```html
<h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Page Title</h1>
<p class="text-slate-500 font-medium">Descriptive subtitle for context.</p>
```

### Data Card
```html
<div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm">
    <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest">Metadata</h3>
    <p class="text-3xl font-black text-slate-900 leading-none">Value</p>
</div>
```

---
*Note: This guide is a living document and should be updated as new patterns emerge.*
