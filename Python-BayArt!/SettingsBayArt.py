from tkinter import *
from PIL import ImageTk, Image
import os

# Ventana
root = Tk()

root.title("BayArt! - Settings")
root.attributes("-fullscreen", TRUE)
root.configure(bg="#242424")

root.update()
rootWidth = root.winfo_width()
rootHeight = root.winfo_height()
background_no_resize = Image.open("background.jpg")
background_resize = background_no_resize.resize(
    (rootWidth+1, rootHeight+2), Image.ANTIALIAS)
background_image = ImageTk.PhotoImage(background_resize)
background = Label(image=background_image)
background.place(x=0, y=0, relwidth=1, relheight=1)


# Logo
logoBayArt_no_resized = Image.open("logo.jpg")

logoBayArt_resized = logoBayArt_no_resized.resize(
    (int(rootWidth/3.4), int(rootHeight/5.12)), Image.ANTIALIAS)

logoBayArt = ImageTk.PhotoImage(logoBayArt_resized)

labelLogoBayArt = Label(root, image=logoBayArt, border=0)
labelLogoBayArt.place(relx=0.5, rely=0.13, anchor=CENTER)


# Carrousel

# Recuadro
divPhotos = Frame(root, bg="#3d3d3d", width=int(
    rootWidth/1.2), height=int(rootHeight/3.5))
divPhotos.place(relx=0.5, rely=0.4, anchor=CENTER)


# Url e index
urlImages = ["1.jpg", "2.jpg", "3.jpg", "4.jpg",
             "5.jpg", "logo.jpg", "11.jpg", "background.jpg"]
stateImages = []
for i in range(len(urlImages)):
    stateImages.append(True)

index = 0


def resizeImage(urlImage):
    image_no_resized = Image.open(urlImage)
    width, height = image_no_resized.size
    if(rootWidth / width < rootHeight / height):
        image_resized = image_no_resized.resize(
            (int(rootWidth/5.5), int((height/width)*(rootWidth/5.5))), Image.ANTIALIAS)
    else:
        image_resized = image_no_resized.resize(
            (int((width/height)*(rootHeight/5.5)), int(rootHeight/5.5)), Image.ANTIALIAS)

    return image_resized


def index_url(add):
    global index
    global urlImages
    if (index + add < len(urlImages)):
        return (index + add)
    else:
        return (index + add-len(urlImages))


def disableEnable1():
    if (stateImages[index_url(0)]):
        stateImages[index_url(0)] = False
        buttondisable1.configure(image=hide_image)
    else:
        stateImages[index_url(0)] = True
        buttondisable1.configure(image=show_image)


def disableEnable2():
    if (stateImages[index_url(1)]):
        stateImages[index_url(1)] = False
        buttondisable2.configure(image=hide_image)
    else:
        stateImages[index_url(1)] = True
        buttondisable2.configure(image=show_image)


def disableEnable3():
    if (stateImages[index_url(2)]):
        stateImages[index_url(2)] = False
        buttondisable3.configure(image=hide_image)
    else:
        stateImages[index_url(2)] = True
        buttondisable3.configure(image=show_image)


def disableEnable4():
    if (stateImages[index_url(3)]):
        stateImages[index_url(3)] = False
        buttondisable4.configure(image=hide_image)
    else:
        stateImages[index_url(3)] = True
        buttondisable4.configure(image=show_image)


# Mostar ocultar
hide_no_resized = Image.open("cancel.png")
hide_resized = hide_no_resized.resize(
    (int(rootWidth/40), int(rootWidth/40)), Image.ANTIALIAS)
hide_image = ImageTk.PhotoImage(hide_resized)

show_no_resized = Image.open("confirm.png")
show_resized = show_no_resized.resize(
    (int(rootWidth/40), int(rootWidth/40)), Image.ANTIALIAS)
show_image = ImageTk.PhotoImage(show_resized)

# Imagen 1
image1 = ImageTk.PhotoImage(resizeImage(urlImages[index_url(0)]))

labelimage1 = Label(root, image=image1, border=0)
labelimage1.place(relx=0.2, rely=0.38, anchor=CENTER)

buttondisable1 = Button(root, image=show_image, border=0, bg="#3d3d3d",
                        activebackground="#3d3d3d", command=disableEnable1)
buttondisable1.place(relx=0.2, rely=0.505, anchor=CENTER)


# Imagen 2
image2 = ImageTk.PhotoImage(resizeImage(urlImages[index_url(1)]))

labelimage2 = Label(root, image=image2, border=0)
labelimage2.place(relx=0.4, rely=0.38, anchor=CENTER)

buttondisable2 = Button(root, image=show_image, border=0, bg="#3d3d3d",
                        activebackground="#3d3d3d", command=disableEnable2)
buttondisable2.place(relx=0.4, rely=0.505, anchor=CENTER)


# Imagen 3
image3 = ImageTk.PhotoImage(resizeImage(urlImages[index_url(2)]))

labelimage3 = Label(root, image=image3, border=0)
labelimage3.place(relx=0.6, rely=0.38, anchor=CENTER)

buttondisable3 = Button(root, image=show_image, border=0, bg="#3d3d3d",
                        activebackground="#3d3d3d", command=disableEnable3)
buttondisable3.place(relx=0.6, rely=0.505, anchor=CENTER)


# Imagen 4
image4 = ImageTk.PhotoImage(resizeImage(urlImages[index_url(3)]))

labelimage4 = Label(root, image=image4, border=0)
labelimage4.place(relx=0.8, rely=0.38, anchor=CENTER)

buttondisable4 = Button(root, image=show_image, border=0, bg="#3d3d3d",
                        activebackground="#3d3d3d", command=disableEnable4)
buttondisable4.place(relx=0.8, rely=0.505, anchor=CENTER)


# Pasar de imagen
def rotate():
    global image1
    global image2
    global image3
    global image4

    image1 = ImageTk.PhotoImage(resizeImage(urlImages[index]))
    labelimage1.configure(image=image1)
    if (stateImages[index_url(0)]):
        buttondisable1.configure(image=show_image)
    else:
        buttondisable1.configure(image=hide_image)

    image2 = ImageTk.PhotoImage(resizeImage(urlImages[(index_url(1))]))
    labelimage2.configure(image=image2)
    if (stateImages[index_url(1)]):
        buttondisable2.configure(image=show_image)
    else:
        buttondisable2.configure(image=hide_image)

    image3 = ImageTk.PhotoImage(resizeImage(urlImages[(index_url(2))]))
    labelimage3.configure(image=image3)
    if (stateImages[index_url(2)]):
        buttondisable3.configure(image=show_image)
    else:
        buttondisable3.configure(image=hide_image)

    image4 = ImageTk.PhotoImage(resizeImage(urlImages[(index_url(3))]))
    labelimage4.configure(image=image4)
    if (stateImages[index_url(3)]):
        buttondisable4.configure(image=show_image)
    else:
        buttondisable4.configure(image=hide_image)


def rotate_left():
    global index
    if(index-1 >= 0):
        index -= 1
    else:
        index = len(urlImages)-1
    rotate()


def rotate_right():
    global index
    if(index+1 < len(urlImages)):
        index += 1
    else:
        index = 0
    rotate()


# FlechaIzq
left_arrow_no_resized = Image.open("left_arrow.png")

left_arrow_resized = left_arrow_no_resized.resize(
    (int(rootWidth/40), int(rootHeight/15)), Image.ANTIALIAS)

left_arrow = ImageTk.PhotoImage(left_arrow_resized)

label_left_arrow = Button(root, image=left_arrow, command=rotate_left,
                          border=0, activebackground="#242424", bg="#242424")
label_left_arrow.place(relx=0.05, rely=0.4, anchor=CENTER)


# FlechaDer
right_arrow_no_resized = Image.open("right_arrow.png")

right_arrow_resized = right_arrow_no_resized.resize(
    (int(rootWidth/40), int(rootHeight/15)), Image.ANTIALIAS)

right_arrow = ImageTk.PhotoImage(right_arrow_resized)

label_right_arrow = Button(root, image=right_arrow, command=rotate_right,
                           activebackground="#242424", border=0, bg="#242424")
label_right_arrow.place(relx=0.95, rely=0.4, anchor=CENTER)

# Show-info
checkBoxInfoVar = BooleanVar()
checkBoxInfo = Checkbutton(variable=checkBoxInfoVar, text="Show Information", font=(
    "Verdana", 20, "bold"), bg="#242424", fg="#7c7c7c", activebackground="#242424", activeforeground="white")
checkBoxInfo.place(relx=0.15, rely=0.7, anchor=CENTER)

# Auto-rotate
checkBoxRotateVar = BooleanVar()
checkBoxRotate = Checkbutton(variable=checkBoxRotateVar, text="Auto Rotate", font=(
    "Verdana", 20, "bold"), bg="#242424", fg="#7c7c7c", activebackground="#242424", activeforeground="white")
checkBoxRotate.place(relx=0.35, rely=0.7, anchor=CENTER)

# Time-Rotation
timeRotation = Label(root, text="Time Rotation (seg):", font=("Verdana", 20, "bold"),
                     bg="#242424", fg="#7c7c7c", highlightthickness=0, activebackground="#242424", bd=0)
timeRotation.place(relx=0.55, rely=0.7, anchor=CENTER)
timeRotationSB = Spinbox(root, width=5, bg="#242424", font=(
    "Verdana", 20, "bold"), fg="#7c7c7c", from_=5, to=300)
timeRotationSB.place(relx=0.69, rely=0.7, anchor=CENTER)

# Play


def openCarrousel():
    var = open("var.txt", "w")
    var.write(str(checkBoxRotateVar.get())+"\n")
    var.write(str(checkBoxInfoVar.get())+"\n")
    var.write(str(timeRotationSB.get())+"\n")

    for x in range(len(urlImages)):
        if (stateImages[x]):
            var.write(urlImages[x]+"\n")

    var.close()
    root.destroy()
    os.system('CarrouselBayArt.py')


playButton = Button(text="Play", font=("Verdana", 15, "bold"), command=openCarrousel, width=int(
    rootWidth/113.33), height=2, bg="#00a797", fg="#242424", activebackground="#674ea7", bd=0)
playButton.place(relx=0.84, rely=0.7, anchor=CENTER)


# Boton cerrar
close_no_resized = Image.open("cancel.png")
close_resized = close_no_resized.resize(
    (int(rootWidth/27.2), int(rootHeight/15.36)), Image.ANTIALIAS)
close_image = ImageTk.PhotoImage(close_resized)

button_close = Button(root, command=root.destroy, image=close_image,
                      highlightthickness=0, bg="#242424", activebackground="#242424", bd=0)
button_close.place(relx=0.98, rely=0.02, anchor=NE)


# Loop
root.mainloop()
