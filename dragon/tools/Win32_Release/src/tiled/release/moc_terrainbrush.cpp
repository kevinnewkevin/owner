/****************************************************************************
** Meta object code from reading C++ file 'terrainbrush.h'
**
** Created: Wed Mar 19 15:42:27 2014
**      by: The Qt Meta Object Compiler version 63 (Qt 4.8.0)
**
** WARNING! All changes made in this file will be lost!
*****************************************************************************/

#include "../../../../tiled/src/tiled/terrainbrush.h"
#if !defined(Q_MOC_OUTPUT_REVISION)
#error "The header file 'terrainbrush.h' doesn't include <QObject>."
#elif Q_MOC_OUTPUT_REVISION != 63
#error "This file was generated using the moc from 4.8.0. It"
#error "cannot be used with the include files from this version of Qt."
#error "(The moc has changed too much.)"
#endif

QT_BEGIN_MOC_NAMESPACE
static const uint qt_meta_data_Tiled__Internal__TerrainBrush[] = {

 // content:
       6,       // revision
       0,       // classname
       0,    0, // classinfo
       1,   14, // methods
       0,    0, // properties
       0,    0, // enums/sets
       0,    0, // constructors
       0,       // flags
       1,       // signalCount

 // signals: signature, parameters, type, tag, flags
      37,   31,   30,   30, 0x05,

       0        // eod
};

static const char qt_meta_stringdata_Tiled__Internal__TerrainBrush[] = {
    "Tiled::Internal::TerrainBrush\0\0tiles\0"
    "currentTilesChanged(const TileLayer*)\0"
};

void Tiled::Internal::TerrainBrush::qt_static_metacall(QObject *_o, QMetaObject::Call _c, int _id, void **_a)
{
    if (_c == QMetaObject::InvokeMetaMethod) {
        Q_ASSERT(staticMetaObject.cast(_o));
        TerrainBrush *_t = static_cast<TerrainBrush *>(_o);
        switch (_id) {
        case 0: _t->currentTilesChanged((*reinterpret_cast< const TileLayer*(*)>(_a[1]))); break;
        default: ;
        }
    }
}

const QMetaObjectExtraData Tiled::Internal::TerrainBrush::staticMetaObjectExtraData = {
    0,  qt_static_metacall 
};

const QMetaObject Tiled::Internal::TerrainBrush::staticMetaObject = {
    { &AbstractTileTool::staticMetaObject, qt_meta_stringdata_Tiled__Internal__TerrainBrush,
      qt_meta_data_Tiled__Internal__TerrainBrush, &staticMetaObjectExtraData }
};

#ifdef Q_NO_DATA_RELOCATION
const QMetaObject &Tiled::Internal::TerrainBrush::getStaticMetaObject() { return staticMetaObject; }
#endif //Q_NO_DATA_RELOCATION

const QMetaObject *Tiled::Internal::TerrainBrush::metaObject() const
{
    return QObject::d_ptr->metaObject ? QObject::d_ptr->metaObject : &staticMetaObject;
}

void *Tiled::Internal::TerrainBrush::qt_metacast(const char *_clname)
{
    if (!_clname) return 0;
    if (!strcmp(_clname, qt_meta_stringdata_Tiled__Internal__TerrainBrush))
        return static_cast<void*>(const_cast< TerrainBrush*>(this));
    return AbstractTileTool::qt_metacast(_clname);
}

int Tiled::Internal::TerrainBrush::qt_metacall(QMetaObject::Call _c, int _id, void **_a)
{
    _id = AbstractTileTool::qt_metacall(_c, _id, _a);
    if (_id < 0)
        return _id;
    if (_c == QMetaObject::InvokeMetaMethod) {
        if (_id < 1)
            qt_static_metacall(this, _c, _id, _a);
        _id -= 1;
    }
    return _id;
}

// SIGNAL 0
void Tiled::Internal::TerrainBrush::currentTilesChanged(const TileLayer * _t1)
{
    void *_a[] = { 0, const_cast<void*>(reinterpret_cast<const void*>(&_t1)) };
    QMetaObject::activate(this, &staticMetaObject, 0, _a);
}
QT_END_MOC_NAMESPACE