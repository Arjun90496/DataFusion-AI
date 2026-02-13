# Tailwind CSS Dark Theme Guide for DataFusion AI

Complete guide to the Tailwind utilities and design patterns used in the premium dark-themed SaaS interface.

---

## Color System

### Background Colors

| Utility | Color Code | Usage |
|---------|-----------|--------|
| `bg-slate-950` | #020617 | Main app background (deepest dark) |
| `bg-slate-900` | #0f172a | Card backgrounds, panels |
| `bg-slate-900/50` | #0f172a at 50% opacity | Form inputs, semi-transparent surfaces |
| `bg-slate-800` | #1e293b | Borders, dividers |

### Text Colors

| Utility | Color Code | Usage |
|---------|-----------|--------|
| `text-slate-100` | #f1f5f9 | Primary text (high contrast) |
| `text-slate-200` | #e2e8f0 | Secondary headings |
| `text-slate-300` | #cbd5e1 | Labels, less important text |
| `text-slate-400` | #94a3b8 | Muted text, placeholders |
| `text-slate-500` | #64748b | Very muted text |

### Accent Colors

| Utility | Color Code | Usage |
|---------|-----------|--------|
| `bg-indigo-600` | #4f46e5 | Primary buttons, CTAs |
| `bg-indigo-500` | #6366f1 | Hover states, highlights |
| `text-indigo-400` | #818cf8 | Links, accent text |
| `border-indigo-500` | #6366f1 | Focus rings, active borders |

### Status Colors

| Utility | Color Code | Usage |
|---------|-----------|--------|
| `text-emerald-500` | #10b981 | Success messages |
| `text-red-500` | #ef4444 | Error messages |
| `text-amber-500` | #f59e0b | Warning messages |
| `text-blue-500` | #3b82f6 | Info messages |

---

## Glassmorphism Effect

The `.glass` custom class creates a frosted glass effect:

```css
.glass {
    background: rgba(15, 23, 42, 0.7); /* slate-900 at 70% opacity */
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(148, 163, 184, 0.1); /* subtle border */
}
```

**Usage:**
```html
<div class="glass p-6 rounded-2xl border border-slate-800">
    <!-- Content -->
</div>
```

**Effect:** Semi-transparent background with blur, creating depth and hierarchy.

---

## Gradient Text

The `.gradient-text` class creates colorful gradient text:

```css
.gradient-text {
    background: linear-gradient(135deg, #818cf8 0%, #c084fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
```

**Usage:**
```html
<h1 class="gradient-text">DataFusion AI</h1>
```

**Effect:** Text filled with indigo-to-purple gradient for eye-catching headings.

---

## Spacing System

Tailwind uses a consistent 0.25rem (4px) spacing scale:

| Utility | Size | Pixels | Common Usage |
|---------|------|--------|--------------|
| `p-2` | 0.5rem | 8px | Tight padding (badges) |
| `p-4` | 1rem | 16px | Button padding |
| `p-6` | 1.5rem | 24px | Card padding |
| `p-8` | 2rem | 32px | Section padding |
| `py-3` | 0.75rem top/bottom | 12px | Input vertical padding |
| `px-4` | 1rem left/right | 16px | Input horizontal padding |
| `space-y-4` | 1rem vertical | 16px | Space between stacked elements |
| `gap-6` | 1.5rem | 24px | Grid/flex gap |

---

## Border Radius

| Utility | Size | Usage |
|---------|------|--------|
| `rounded-lg` | 0.5rem | Standard buttons, inputs |
| `rounded-xl` | 0.75rem | Medium cards |
| `rounded-2xl` | 1rem | Large cards, panels |
| `rounded-full` | 9999px | Circles, pills, badges |

---

## Shadows

Dark theme requires subtle, colored shadows:

| Utility | Effect |
|---------|--------|
| `shadow-lg` | Standard large shadow |
| `shadow-xl` | Extra large shadow |
| `shadow-2xl` | Maximum shadow for depth |
| `shadow-indigo-500/40` | Indigo shadow at 40% opacity (glow effect) |
| `shadow-emerald-500/20` | Green shadow at 20% (success cards) |

**Example: Glowing Button**
```html
<button class="shadow-lg shadow-indigo-500/40 hover:shadow-indigo-500/60">
    Get Started
</button>
```

---

## Typography

### Font Sizes

| Utility | Size | Usage |
|---------|------|--------|
| `text-xs` | 0.75rem (12px) | Small labels, captions |
| `text-sm` | 0.875rem (14px) | Body text, inputs |
| `text-base` | 1rem (16px) | Default body text |
| `text-lg` | 1.125rem (18px) | Emphasized text |
| `text-xl` | 1.25rem (20px) | Subheadings |
| `text-2xl` | 1.5rem (24px) | Card headings |
| `text-4xl` | 2.25rem (36px) | Section headings |
| `text-5xl` | 3rem (48px) | Hero headings |
| `text-7xl` | 4.5rem (72px) | Large hero text |

### Font Weights

| Utility | Weight | Usage |
|---------|--------|--------|
| `font-normal` | 400 | Body text |
| `font-medium` | 500 | Navigation links |
| `font-semibold` | 600 | Subheadings |
| `font-bold` | 700 | Headings, buttons |

---

## Transitions & Animations

### Standard Transitions

```html
<!-- Smooth all properties -->
<div class="transition-all duration-300">

<!-- Specific property transitions -->
<div class="transition-colors duration-200">
<div class="transition-transform duration-300">
```

| Utility | Duration | Usage |
|---------|----------|--------|
| `duration-200` | 200ms | Quick hover effects |
| `duration-300` | 300ms | Standard transitions |
| `duration-500` | 500ms | Slower, emphasized transitions |

### Custom Animations

**Fade In:**
```html
<div class="animate-fade-in">
```

**Slide Up:**
```html
<div class="animate-slide-up">
```

**Gradient Background:**
```html
<div class="gradient-bg">
```

Defined in the custom Tailwind config in `layout.blade.php`.

---

## Interactive States

### Hover States

```html
<!-- Background change -->
<button class="bg-indigo-600 hover:bg-indigo-700">

<!-- Text color change -->
<a class="text-slate-400 hover:text-slate-200">

<!-- Border glow -->
<div class="border-slate-800 hover:border-indigo-500/50">

<!-- Scale effect -->
<button class="hover:scale-105">

<!-- Shadow intensity -->
<div class="shadow-lg hover:shadow-2xl">
```

### Focus States

All form inputs should have visible focus rings:

```html
<input class="focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
```

**Breakdown:**
- `focus:ring-2` - 2px ring on focus
- `focus:ring-indigo-500` - Indigo color ring
- `focus:border-transparent` - Hide the default border when focused

---

## Form Inputs (Dark Theme)

Standard input styling for dark backgrounds:

```html
<input 
    type="text"
    class="w-full px-4 py-3 
           bg-slate-900/50 
           border border-slate-700 
           text-slate-100 
           rounded-lg 
           placeholder:text-slate-500 
           focus:ring-2 focus:ring-indigo-500 focus:border-transparent 
           transition duration-200"
    placeholder="Enter text"
>
```

**Breakdown:**
- `bg-slate-900/50` - Dark, semi-transparent background
- `border-slate-700` - Subtle border
- `text-slate-100` - Light text for readability
- `placeholder:text-slate-500` - Muted placeholder
- Focus states for accessibility

---

## Buttons

### Primary Button (Gradient with Glow)

```html
<button class="px-6 py-3 
               bg-gradient-to-r from-indigo-600 to-purple-600 
               hover:from-indigo-700 hover:to-purple-700 
               text-white 
               rounded-lg 
               font-semibold 
               shadow-lg shadow-indigo-500/40 
               hover:shadow-indigo-500/60 
               transition-all duration-300 
               hover:scale-105">
    Click Me
</button>
```

**Features:**
- Gradient background (indigo to purple)
- Glowing shadow that intensifies on hover
- Slight scale increase on hover
- Smooth transitions

### Secondary Button (Glass Style)

```html
<button class="px-6 py-3 
               glass 
               border border-slate-700 
               hover:border-indigo-500/50 
               text-slate-300 
               rounded-lg 
               font-semibold 
               transition-all duration-300 
               hover:scale-105">
    Learn More
</button>
```

---

## Card Patterns

### Stat Card with Hover Effect

```html
<div class="glass p-6 rounded-2xl 
            border border-slate-800 
            hover:border-indigo-500/50 
            transition-all duration-300 
            group">
    <div class="p-3 
                bg-indigo-500/10 
                rounded-xl 
                group-hover:bg-indigo-500/20 
                transition-colors">
        <!-- Icon SVG -->
    </div>
    <h3 class="text-slate-100">Title</h3>
    <p class="text-slate-400">Description</p>
</div>
```

**Features:**
- `group` - Parent for coordinated hover effects
- Icon background lightens when card is hovered
- Border glows on hover
- Glassmorphism effect

### Feature Card

```html
<div class="glass p-8 rounded-2xl 
            border border-slate-800 
            hover:border-indigo-500/50 
            hover:shadow-2xl hover:shadow-indigo-500/10 
            hover:-translate-y-1 
            transition-all duration-300">
    <div class="w-14 h-14 
                bg-indigo-500/10 
                rounded-xl 
                flex items-center justify-center">
        <!-- Icon -->
    </div>
    <h3 class="text-2xl font-bold text-slate-100">Title</h3>
    <p class="text-slate-400">Description</p>
</div>
```

**Features:**
- Lifts slightly on hover (`-translate-y-1`)
- Adds glowing shadow on hover
- Border glows on hover

---

## Layout Utilities

### Flexbox

```html
<!-- Horizontal layout with spacing -->
<div class="flex items-center space-x-4">

<!-- Vertical layout with spacing -->
<div class="flex flex-col space-y-4">

<!-- Center content -->
<div class="flex items-center justify-center">

<!-- Space between items -->
<div class="flex justify-between items-center">
```

### Grid

```html
<!-- Responsive grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Items -->
</div>
```

**Breakdown:**
- `grid-cols-1` - 1 column on mobile
- `md:grid-cols-2` - 2 columns on medium screens (768px+)
- `lg:grid-cols-3` - 3 columns on large screens (1024px+)
- `gap-6` - 1.5rem (24px) gap between items

---

## Responsive Design

Tailwind uses mobile-first responsive prefixes:

| Prefix | Breakpoint | Screen Size |
|--------|------------|-------------|
| (none) | < 640px | Mobile |
| `sm:` | ≥ 640px | Small tablets |
| `md:` | ≥ 768px | Tablets |
| `lg:` | ≥ 1024px | Laptops |
| `xl:` | ≥ 1280px | Desktops |

**Example:**
```html
<!-- Stacks on mobile, 2 columns on tablet, 4 on desktop -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
```

---

## Best Practices for Dark Themes

### 1. Contrast Ratios

Ensure text has sufficient contrast against dark backgrounds:
- **Primary text** (`slate-100`) on `slate-950`: ✅ WCAG AAA
- **Secondary text** (`slate-400`) on `slate-950`: ✅ WCAG AA

### 2. Avoid Pure Black

Use `slate-950` (#020617) instead of `black` (#000000) to:
- Reduce eye strain
- Create depth with darker shadows
- Allow for true black accents when needed

### 3. Layer with Opacity

Create depth by layering semi-transparent elements:
```html
<div class="bg-slate-900/90 backdrop-blur-lg">
```

### 4. Subtle Borders

Use barely-visible borders to define sections:
```html
<div class="border border-slate-800">
```

### 5. Colored Shadows for Glow Effects

Add subtle color to shadows for premium feel:
```html
<button class="shadow-lg shadow-indigo-500/40">
```

### 6. Smooth Transitions

Always add transitions to interactive elements:
```html
<button class="transition-all duration-300">
```

---

## Common Patterns Library

### Navigation Link (Active State)

```html
<!-- Active -->
<a class="flex items-center space-x-3 px-4 py-3 
         rounded-lg 
         bg-indigo-600/20 
         border border-indigo-500/50 
         text-indigo-300">
    <svg>...</svg>
    <span>Dashboard</span>
</a>

<!-- Inactive -->
<a class="flex items-center space-x-3 px-4 py-3 
         rounded-lg 
         text-slate-400 
         hover:text-slate-200 
         hover:bg-slate-800/50 
         transition-colors">
    <svg>...</svg>
    <span>Link</span>
</a>
```

### Badge

```html
<span class="inline-flex items-center space-x-2 
             glass px-4 py-2 
             rounded-full 
             text-sm 
             text-indigo-300 
             border border-indigo-500/30">
    <svg class="w-4 h-4">...</svg>
    <span>AI-Powered</span>
</span>
```

### Divider

```html
<!-- Horizontal -->
<div class="border-t border-slate-800"></div>

<!-- With text -->
<div class="relative my-6">
    <div class="absolute inset-0 flex items-center">
        <div class="w-full border-t border-slate-800"></div>
    </div>
    <div class="relative flex justify-center text-sm">
        <span class="px-4 bg-slate-900 text-slate-500">Or</span>
    </div>
</div>
```

---

## Accessibility Features

### 1. Focus Rings

Always visible focus states:
```html
<button class="focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0">
```

### 2. Skip Links (for keyboard users)

```html
<a href="#main-content" class="sr-only focus:not-sr-only">
    Skip to main content
</a>
```

### 3. ARIA Labels

```html
<button aria-label="Close menu">
    <svg>...</svg>
</button>
```

### 4. Semantic HTML

Use proper HTML5 semantic elements:
- `<nav>` for navigation
- `<main>` for main content
- `<aside>` for sidebars
- `<article>` for self-contained content

---

## Performance Tips

### 1. Use Tailwind's JIT Mode

Already enabled via CDN in our setup.

### 2. Minimize Custom CSS

Prefer Tailwind utilities over custom CSS when possible.

### 3. Optimize Images

Always use optimized images and lazy loading:
```html
<img src="..." alt="..." loading="lazy">
```

### 4. Reduce Animation Complexity

Use simple transitions (opacity, transform) over expensive properties (box-shadow, filter).

---

## Summary

This dark-themed SaaS design uses:
- **Slate color scale** for backgrounds and text
- **Indigo gradients** for accents and CTAs
- **Glassmorphism** for depth and modern aesthetics
- **Subtle shadows** with color for premium feel
- **Smooth transitions** for polished interactions
- **Responsive grid** for all screen sizes
- **High contrast** for accessibility

All Tailwind utilities are documented above for easy reference when building new features!
