<<<<<<< HEAD
from tkinter import *
from PIL import ImageTk, Image
import os

# Ventana
root = Tk()

root.title("BayArt!")
root.attributes("-fullscreen", TRUE)
root.configure(bg="#242424")

root.update()
rootWidth = root.winfo_width()
rootHeight = root.winfo_height()


# Fondo
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
labelLogoBayArt.place(relx=0.5, rely=0.2, anchor=CENTER)

# Login
# Recuadro
divLogin = Frame(root, bg="#3d3d3d", width=int(
    rootWidth/2.25), height=int(rootHeight/2.25))
divLogin.place(relx=0.5, rely=0.6, anchor=CENTER)


# Username
usernameLabel = Label(root, text="Username", font=(
    "Verdana", 20, "bold"), bg="#3d3d3d", fg="white")
usernameEntry = Entry(root, width=int(rootWidth/44.21),
                      font=("Verdana", 15, "bold"), bg="#7c7c7c", fg="white", bd=0)

usernameLabel.place(relx=0.37, rely=0.45, anchor=CENTER)
usernameEntry.place(relx=0.50, rely=0.51, anchor=CENTER)


# Password
passwordLabel = Label(root, text="Password", font=(
    "Verdana", 20, "bold"), bg="#3d3d3d", fg="white")
passwordEntry = Entry(root, width=int(rootWidth/44.21), font=("Verdana",
                                                              15, "bold"), show="*", bg="#7c7c7c", fg="white", bd=0)

passwordLabel.place(relx=0.37, rely=0.57, anchor=CENTER)
passwordEntry.place(relx=0.50, rely=0.63, anchor=CENTER)


# LogIn
def openSettings():
    root.destroy()
    os.system('SettingsBayArt.py')


logInButton = Button(text="LogIn", font=("Verdana", 15, "bold"), command=openSettings, width=int(
    rootWidth/113.33), height=2, bg="#00a797", fg="#242424", activebackground="#674ea7", bd=0)
logInButton.place(relx=0.63, rely=0.74, anchor=CENTER)


# Boton cerrar
close_no_resized = Image.open("cancel.png")
close_resized = close_no_resized.resize(
    (int(rootWidth/27.2), int(rootHeight/15.36)), Image.ANTIALIAS)
close_image = ImageTk.PhotoImage(close_resized)

button_close = Button(root, command=openSettings, image=close_image,
                      highlightthickness=0, bg="#242424", activebackground="#242424", bd=0)
button_close.place(relx=0.98, rely=0.02, anchor=NE)


# Loop
root.mainloop()
=======
from tkinter import *
from PIL import ImageTk, Image
import os

# Ventana
root = Tk()

root.title("BayArt!")
root.attributes("-fullscreen", TRUE)
root.configure(bg="#242424")

root.update()
rootWidth = root.winfo_width()
rootHeight = root.winfo_height()


# Fondo
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
labelLogoBayArt.place(relx=0.5, rely=0.2, anchor=CENTER)

# Login
# Recuadro
divLogin = Frame(root, bg="#3d3d3d", width=int(
    rootWidth/2.25), height=int(rootHeight/2.25))
divLogin.place(relx=0.5, rely=0.6, anchor=CENTER)


# Username
usernameLabel = Label(root, text="Username", font=(
    "Verdana", 20, "bold"), bg="#3d3d3d", fg="white")
usernameEntry = Entry(root, width=int(rootWidth/44.21),
                      font=("Verdana", 15, "bold"), bg="#7c7c7c", fg="white", bd=0)

usernameLabel.place(relx=0.37, rely=0.45, anchor=CENTER)
usernameEntry.place(relx=0.50, rely=0.51, anchor=CENTER)


# Password
passwordLabel = Label(root, text="Password", font=(
    "Verdana", 20, "bold"), bg="#3d3d3d", fg="white")
passwordEntry = Entry(root, width=int(rootWidth/44.21), font=("Verdana",
                                                              15, "bold"), show="*", bg="#7c7c7c", fg="white", bd=0)

passwordLabel.place(relx=0.37, rely=0.57, anchor=CENTER)
passwordEntry.place(relx=0.50, rely=0.63, anchor=CENTER)


# LogIn
def openSettings():
    root.destroy()
    os.system('SettingsBayArt.py')


logInButton = Button(text="LogIn", font=("Verdana", 15, "bold"), command=openSettings, width=int(
    rootWidth/113.33), height=2, bg="#00a797", fg="#242424", activebackground="#674ea7", bd=0)
logInButton.place(relx=0.63, rely=0.74, anchor=CENTER)


# Boton cerrar
close_no_resized = Image.open("cancel.png")
close_resized = close_no_resized.resize(
    (int(rootWidth/27.2), int(rootHeight/15.36)), Image.ANTIALIAS)
close_image = ImageTk.PhotoImage(close_resized)

button_close = Button(root, command=openSettings, image=close_image,
                      highlightthickness=0, bg="#242424", activebackground="#242424", bd=0)
button_close.place(relx=0.98, rely=0.02, anchor=NE)


# Loop
root.mainloop()
>>>>>>> d8d30ef8c71a05a3c367f1d0651cf2253999a83d
